<?php

namespace App\Http\Controllers;
use App\Models\Patient;
use App\Models\Service;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class FinanceContoller extends Controller
{
    public function view()
    {
        return view('finance.view');
    }
    // Ödeme Oluştur
     public function sendPayment()
    {
        $customers = Patient::all();
        $services  = Service::all();

        return view('finance.payment-send' ,compact('customers','services'));
    }
    // Ödeme Oluşturma İşlemi
    public function sendPaymentStore(Request $request)
    {
       try {
        $request->validate([
            'customer_id' => 'required|integer',
            'service_id'  => 'required|integer',
            'discount'    => 'nullable|numeric|min:0',
        ]);

        // Servis bilgisi
        $service = Service::findOrFail($request->service_id);

        $originalPrice = $service->price;
        $discount = $request->discount ?? 0;

        // İndirimli fiyat hesaplama
        $finalPrice = $originalPrice - $discount;
        if ($finalPrice < 0) {
            $finalPrice = 0;
        }

        // Ödeme kaydı oluşturma
        $payment = Payment::create([
            'customer_id'   => $request->customer_id,
            'service_id'    => $request->service_id,
            'service_price' => $originalPrice,
            'discount'      => $discount,
            'final_price'   => $finalPrice,
            'payment_status'=> 'Beklemede',
            'user_id'       => auth()->id() ?? 1, 
        ]);

        // ------------------------------
        // Fake SMS gönderme 
        // ------------------------------
        $customer = Customer::find($request->customer_id);
        $message = "Merhaba {$customer->fullname}, ödemeniz başarıyla kaydedildi. Ödenecek tutar: {$finalPrice}₺";

        return response()->json([
            'status'  => 'success',
            'message' => 'Ödeme başarıyla oluşturuldu ve SMS gönderildi.',
            'data'    => $payment
        ]);

        } catch (Exception $e) {

        Log::error('Ödeme oluşturma hatası: '.$e->getMessage(), [
            'customer_id' => $request->customer_id ?? null,
            'service_id'  => $request->service_id ?? null,
            'discount'    => $request->discount ?? null,
            'trace'       => $e->getTraceAsString(),
        ]);

        return response()->json([
            'status'  => 'error',
            'message' => 'Ödeme oluşturulurken bir hata oluştu. Detaylar loglandı.',
        ], 500);
      }
    }
    // Ödeme Tamamlama Sayfası
    public function createPayment()
    {
        return view('finance.create-payment');
    }
    // Ödemeleri Listele
    public function fetch(Request $request)
    {
      $columns = [
        0 => 'payment.id',
        1 => 'patients.name',
        2 => 'services.name',
        3 => 'payment.service_price',
        4 => 'payment.discount',
        5 => 'payment.final_price',
        6 => 'payment.payment_status',
        7 => 'payment.created_at'
       ];

       $query = Payment::query()
        ->leftJoin('patients', 'patients.id', '=', 'payment.customer_id')
        ->leftJoin('services', 'services.id', '=', 'payment.service_id')
        ->select(
            'payment.*',
            'patients.fullname as patient_name',
            'services.name as service_name'
        );
       if ($request->order) {
        $orderCol = $columns[$request->order[0]['column']];
        $orderDir = $request->order[0]['dir'];
        $query->orderBy($orderCol, $orderDir);
       }

       $start = $request->start ?? 0;
       $length = $request->length ?? 10;

       $totalRecords = Payment::count();

        $data = $query->skip($start)->take($length)->get();

        // İşlem butonu ekle
        $data->transform(function ($row) {
        $row->actions = '
            <button class="btn btn-sm btn-primary editStatusBtn"
                data-id="'.$row->id.'"
                data-status="'.$row->payment_status.'">
                Durumu Değiştir
            </button>';
        return $row;
        });

        return response()->json([
        'draw' => intval($request->draw),
        'recordsTotal' => $totalRecords,
        'recordsFiltered' => $totalRecords,
        'data' => $data
        ]);
    }
    // Ödeme Durumunu Güncelle
    public function paymentStatusUpdate(Request $request)
    {
      $request->validate([
        'payment_id' => 'required|exists:payment,id',
        'payment_status' => 'required|string|in:Beklemede,Ödeme Tamamlandı,İptal Edildi,İade Edildi'
      ]);

      // Ödeme kaydını bul
      $payment = Payment::find($request->payment_id);

      if (!$payment) {
        return response()->json(['success' => false, 'message' => 'Ödeme kaydı bulunamadı.'], 404);
      }

      // Durumu güncelle
      $payment->payment_status = $request->payment_status;
      $payment->save();

      return response()->json(['success' => true, 'message' => 'Ödeme durumu başarıyla güncellendi.']);
    }
    




}
