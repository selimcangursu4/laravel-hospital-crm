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
    
}
