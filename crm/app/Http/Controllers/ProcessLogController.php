<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\ProcessLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProcessLogController extends Controller
{
    public function store(Request $request)
    {
        try {
            $patient_id = $request->input('processPatientId');
            $service_id = $request->input('processServiceId');
            $doctor_id = $request->input('processDoctor');
            $description = $request->input('processDescription');
            $status = $request->input('processStatus');

            $processCreate = new ProcessLog();
            $processCreate->patient_id = $patient_id;
            $processCreate->process_type_id = $service_id;
            $processCreate->description = $description;
            $processCreate->doctor_id = $doctor_id;
            $processCreate->status_id = $status;
            $processCreate->user_id = auth()->user()->id ?? 1;
            $processCreate->save();

            return response()->json([
                'success' => true,
                'message' => 'Hasta İşlemi Başarıyla Eklendi'
            ]);

        } catch (Exception $th) {
            // Hata loglama
            Log::error('ProcessLog Store Hatası: ' . $th->getMessage(), [
                'patient_id' => $request->input('processPatientId'),
                'service_id' => $request->input('processServiceId'),
                'doctor_id' => $request->input('processDoctor'),
                'user_id' => auth()->user()->id ?? 1
            ]);

            return response()->json([
                'success' => false,
                'message' => 'İşlem sırasında bir hata oluştu. Lütfen tekrar deneyin.'
            ], 500);
        }
    }
}