<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreAppointment;
use App\Models\LeadActivity;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\DB;


class PreAppointmentController extends Controller
{
    // Yeni Ön Muayene Ekle
    public function store(Request $request)
    {
        try {
            $request->validate([
                'lead_id' => 'required|integer',
                'appointment_date' => 'required|date',
                'appointment_service_id' => 'required|integer',
                'appointment_note' => 'nullable|string'
            ]);

            // Kayıt oluşturma
            $preAppointment = PreAppointment::create([
                'lead_id' => $request->lead_id,
                'service_id' => $request->appointment_service_id,
                'appointment_datetime' => $request->appointment_date,
                'note' => $request->appointment_note,
                'status_id' => 10 
            ]);

            $newLeadActivity = new LeadActivity();
            $newLeadActivity->lead_id = $request->lead_id;
            $newLeadActivity->lead_status_id = 10;
            $newLeadActivity->description = "Ön Görüşme Planlandı";
            $newLeadActivity->user_id = Auth::id() ?? 1;
            $newLeadActivity->save();

            return response()->json([
                'status' => true,
                'message' => 'Ön randevu başarıyla oluşturuldu.',
                'data' => $preAppointment
            ], 200);

        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Ön randevu oluşturulurken bir hata oluştu.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    // Ön Muayene Listele
    public function fetch()
    {
      try {

        $appointments = DB::table('pre_appointments as pa')
            ->leftJoin('leads as l', 'pa.lead_id', '=', 'l.id')
            ->leftJoin('services as s', 'pa.service_id', '=', 's.id')
            ->select(
                'pa.id',
                'pa.lead_id',
                'l.fullname as patient_name',
                'pa.appointment_datetime',
                'pa.status_id',
                's.name as service_name'
            )
            ->orderBy('pa.appointment_datetime', 'desc')
            ->get();

        return response()->json([
            'data' => $appointments
        ]);

       } catch (\Throwable $e) {

        Log::error('Fetch PreAppointments Error: ' . $e->getMessage(), [
            'file'  => $e->getFile(),
            'line'  => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);

        return response()->json([
            'status' => false,
            'message' => 'Ön randevular listelenirken bir hata oluştu.',
            'error' => $e->getMessage()
        ], 500);
      }
    }
    // Ön Muayene Durum Güncelleme ve Lead Aktivitesi Oluştuma
    public function statusUpdate(Request $request)
    {
      try {
        $lead_id = $request->input('lead_id');
        $note = $request->input('note');
        $status_id = $request->input('status_id');

        // PreAppointment Tablosunda Durum Güncelleme
        $preAppointment = PreAppointment::where('lead_id', $lead_id)->first();

        if ($preAppointment) {
            $preAppointment->note = $note;
            $preAppointment->status_id = $status_id;
            $preAppointment->save();
        }

        // Lead Aktivite Ekleme
        $newLeadActivity = new LeadActivity();
        $newLeadActivity->lead_id = $lead_id;
        $newLeadActivity->lead_status_id = 7; // Örn: Ön Görüşme Tamamlandı
        $newLeadActivity->description = "Ön Görüşme Tamamlandı";
        $newLeadActivity->user_id = Auth::id() ?? 1;
        $newLeadActivity->save();

        return response()->json([
            'success' => true,
            'message' => "Randevu Bilgileri Güncellendi"
        ]);

       } catch (\Throwable $th) {
        \Log::error('Ön Görüşme Durumu Güncellenemedi : ' . $th->getMessage(), [
            'file' => $th->getFile(),
            'line' => $th->getLine(),
            'trace' => $th->getTraceAsString(),
        ]);

        return response()->json([
            'success' => false,
            'message' => "Randevu bilgileri güncellenirken hata oluştu.",
            'error' => $th->getMessage()
        ], 500);
       }
    }
    
}
