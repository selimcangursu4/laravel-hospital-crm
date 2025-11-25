<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientCallLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class PatientCallLogController extends Controller
{
   public function logOutgoingCall(Request $request)
    {
        try {
            $request->validate([
                'patientId' => 'required|exists:leads,id',
            ]);

            // Anlaşmalı Santral Firmasından Gelen Api Verileri Burada Çekilecek !

            $patientCallLog = new PatientCallLog();
            $patientCallLog->patient_id = $request->input('patientId');
            $patientCallLog->call_type = 'outgoing';
            $patientCallLog->call_duration = null; // Anlaşmalı Santral Apisinden Gelen Veri
            $patientCallLog->call_status = 'completed'; // Varsayılan olarak tamamlandı fakat Anlaşmalı Santral Apisinden Gelen Veri ile güncellenebilir
            $patientCallLog->called_by = Auth::id() ?? 1;
            $patientCallLog->save();

            return response()->json([
                'success' => true,
                'message' => 'Arama logu başarıyla kaydedildi.',
                'log' => $patientCallLog
            ]);
        } catch (\Exception $e) {
            Log::error('Lead arama loglama hatası: ' . $e->getMessage(), [
                'request' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Arama logu kaydedilemedi: ' . $e->getMessage()
            ], 500);
        }
    }
}
