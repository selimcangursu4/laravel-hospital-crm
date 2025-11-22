<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeadCallLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LeadCallLogController extends Controller
{
    /**
     * Giden aramayı logla
     */
    public function logOutgoingCall(Request $request)
    {
        try {
            $request->validate([
                'lead_id' => 'required|exists:leads,id',
            ]);

            // Anlaşmalı Santral Firmasından Gelen Api Verileri Burada Çekilecek !

            $leadCallLog = new LeadCallLog();
            $leadCallLog->lead_id = $request->input('lead_id');
            $leadCallLog->call_type = 'outgoing';
            $leadCallLog->call_duration = null; // Anlaşmalı Santral Apisinden Gelen Veri
            $leadCallLog->call_status = 'completed'; // Varsayılan olarak tamamlandı fakat Anlaşmalı Santral Apisinden Gelen Veri ile güncellenebilir
            $leadCallLog->called_by = Auth::id() ?? 1;
            $leadCallLog->save();

            return response()->json([
                'success' => true,
                'message' => 'Arama logu başarıyla kaydedildi.',
                'log' => $leadCallLog
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
