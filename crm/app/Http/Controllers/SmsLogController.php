<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SmsLog;
use App\Models\PatientSmsLog;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SmsLogController extends Controller
{
    // Lead Sms Gönderme
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone'   => 'required|string|max:20',
            'message' => 'required|string|max:500',
            'lead_id' => 'nullable|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        try {
            $phone   = $request->input('phone');
            $message = $request->input('message');

            // SMS API ENTEGRASYONU BURAYA GELECEK


            $createSms = new SmsLog();
            $createSms->phone_number = $phone;
            $createSms->message      = $message;
            $createSms->status       = 'pending';  // api'den cevap alınca güncellenebilir
            $createSms->lead_id      = $request->input('lead_id') ?? null;
            $createSms->user_id      = auth()->id() ?? 1;
            $createSms->save();

            return response()->json([
                'status'  => true,
                'message' => 'SMS kaydı başarıyla oluşturuldu.',
                'data'    => $createSms
            ], 201);
        } catch (\Throwable $th) {

            Log::error('SMS Eklenemedi Hata: ' . $th->getMessage());

            return response()->json([
                'status'  => false,
                'message' => 'SMS kaydı oluşturulamadı.',
            ], 500);
        }
    }
    // Patient Sms Gönderme
    public function patientSmsStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'smsPhone'   => 'required|string|max:20',
            'smsMessage' => 'required|string|max:500',
            'dataId' => 'nullable|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        try {
            $phone   = $request->input('smsPhone');
            $message = $request->input('smsMessage');

            // SMS API ENTEGRASYONU BURAYA GELECEK


            $createSms = new PatientSmsLog();
            $createSms->phone_number = $phone;
            $createSms->message      = $message;
            $createSms->status       = 'pending';  // api'den cevap alınca güncellenebilir
            $createSms->lead_id      = $request->input('dataId') ?? null;
            $createSms->user_id      = auth()->id() ?? 1;
            $createSms->save();

            return response()->json([
                'status'  => true,
                'message' => 'SMS kaydı başarıyla oluşturuldu.',
                'data'    => $createSms
            ], 201);
        } catch (\Throwable $th) {

            Log::error('SMS Eklenemedi Hata: ' . $th->getMessage());

            return response()->json([
                'status'  => false,
                'message' => 'SMS kaydı oluşturulamadı.',
            ], 500);
        }
    }
}
