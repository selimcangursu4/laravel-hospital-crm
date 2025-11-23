<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeadActivity;
use App\Models\Lead;
use App\Models\Patient;
use Exception;

class LeadActivityController extends Controller
{
    // Yeni Aktivite Ekleme Post İşlemi
    public function store(Request $request)
    {
        try {

            $lead_id = $request->input('lead_id');
            $lead_status_id = $request->input('status_id');
            $description = $request->input('description');

            $newActivity = new LeadActivity();
            $newActivity->lead_id = $lead_id;
            $newActivity->lead_status_id = $lead_status_id;
            $newActivity->description = $description;
            $newActivity->user_id = auth()->user()->id ?? 1;
            $newActivity->save();

            // Lead Başarılı Kapatma İse Hasta Olarak Otomatik Ekle
            if($lead_status_id == 6)
            {
                $lead = Lead::find($lead_id);
                if($lead)
                {
                    $patient = new Patient();
                    $patient->fullname = $lead->fullname;
                    $patient->email = $lead->email;
                    $patient->phone = $lead->phone;
                    $patient->birth_date = $lead->birth_date;
                    $patient->gender_id = $lead->gender_id;
                    $patient->country_id = $lead->country_id;
                    $patient->city_id = $lead->city_id;
                    $patient->address = null;
                    $patient->service_id = $lead->service_id;
                    $patient->source_id = $lead->source_id;
                    $patient->user_id = $lead->user_id;
                    $patient->doctor_id = null;
                    $patient->patient_status_id = 1; // Yeni Hasta Kaydı
                    $patient->height =null;
                    $patient->weight = null;
                    $patient->emergency_contact_name = null;
                    $patient->save();
                }
            }

            return response()->json(['success' => true, 'message' => 'Aktivite başarıyla eklendi.']);
        } catch (Exception $th) {
            return response()->json(['success' => false, 'message' => 'Aktivite eklenirken bir hata oluştu: ' . $th->getMessage()]);

        }
    }
}
