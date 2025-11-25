<?php

namespace App\Http\Controllers;

use App\Models\SurgeryAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SurgeryAppointmentController extends Controller
{
    public function store(Request $request)
    {
        try {

            $createOperation = new SurgeryAppointment();
            $createOperation->patient_id = $request->operationPatientId;
            $createOperation->scheduled_at = $request->scheduledAt;
            $createOperation->doctor_id = $request->doctor_id;
            $createOperation->surgery_type_id = $request->surgeryTypeId;
            $createOperation->operation_room_id = $request->operationRoomId;
            $createOperation->status_id = $request->statusId;
            $createOperation->notes = $request->notes;
            $createOperation->user_id = auth()->user()->id ?? 1;
            $createOperation->save();

            return response()->json([
                'success' => true,
                'message' => 'Ameliyat randevusu başarıyla kaydedildi.'
            ]);

        } catch (\Throwable $th) {

            Log::error("SurgeryAppointment Store Error: " . $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Bir hata oluştu: ' . $th->getMessage()
            ], 500);
        }
    }
}
