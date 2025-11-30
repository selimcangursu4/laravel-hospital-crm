<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreAppointment;
use Exception;

class PreAppointmentController extends Controller
{
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
                'status_id' => 1 // Randevu Oluşturuldu 2 İptal Edildi 3 Tamamlandı 
            ]);

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
}
