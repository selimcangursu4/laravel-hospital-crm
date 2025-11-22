<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeadActivity;
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

            return response()->json(['success' => true, 'message' => 'Aktivite başarıyla eklendi.']);
        } catch (Exception $th) {
            return response()->json(['success' => false, 'message' => 'Aktivite eklenirken bir hata oluştu: ' . $th->getMessage()]);

        }
    }
}
