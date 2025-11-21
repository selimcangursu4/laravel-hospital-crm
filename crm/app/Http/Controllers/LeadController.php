<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\LeadSource;
use App\Models\LeadStatus;
use App\Models\Service;
use App\Models\User;
use App\Models\Lead;
use Exception;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    // Lead View Sayfası
    public function view()
    {
        return view('leads.view');
    }
    // Tüm Leadler Sayfası
    public function index()
    {
        $services = Service::all();
        $sources = LeadSource::all();
        $statuses = LeadStatus::all();
        $users = User::all();

        return view('leads.index',compact('services','sources','statuses','users'));
    }
    // Yeni Lead Oluşturma Sayfası
    public function create()
    {
        $sources = LeadSource::all();
        $services = Service::all();
        return view('leads.create',compact('sources','services'));
    }
    // Lead Durumu Sayfası
    public function status(){
        return view('leads.lead-status');
    }
    // Lead Kaynakları Sayfası
    public function leadSources(){
        return view('leads.lead-source');
    }
    // Mini Lead Rapor Sayfası
    public function miniReport(){
        return view('leads.reports-leads');
    }
    // Lead Ekleme Post İşlemi
    public function store(Request $request)
    {
      try {
        $fullname = $request->input('fullname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $birth_date = $request->input('birth_date');
        $gender_id = $request->input('gender_id');
        $country_id = $request->input('country_id');
        $city_id = $request->input('city_id');
        $service_id = $request->input('service_id');
        $source_id = $request->input('source_id');
        $note = $request->input('note');

        // Yeni Lead Ekleme
        $newLead = new Lead();
        $newLead->fullname = $fullname;
        $newLead->email = $email;
        $newLead->phone = $phone;
        $newLead->birth_date = $birth_date;
        $newLead->gender_id = $gender_id;
        $newLead->country_id = $country_id;
        $newLead->city_id = $city_id;
        $newLead->service_id = $service_id;
        $newLead->source_id = $source_id;
        $newLead->user_id = auth()->user()->id ?? 1;
        $newLead->lead_status_id = 1;
        $newLead->note = $note;
        $newLead->save();

        return response()->json([
            'success' => true,
            'message' => 'Lead başarıyla eklendi.'
        ]);

      } catch (Exception $th) {
        // Hata Yakala
        Log::error('Lead ekleme hatası: ' . $th->getMessage(), [
            'request' => $request->all(),
            'trace' => $th->getTraceAsString()
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Lead eklenirken bir hata oluştu.',
            'error' => $th->getMessage()
        ]);
      }
    }
    // Tüm Leadleri Getirme
    public function fetch(Request $request)
    {
    $query = Lead::select(
        'leads.id',
        'leads.fullname',
        'leads.phone',
        'leads.gender_id',
        'services.name as service_name',
        'lead_sources.name as source_name',
        'lead_statues.name as status_name',
        'users.name as user_name'
    )
    ->leftJoin('services', 'leads.service_id', '=', 'services.id')
    ->leftJoin('lead_sources', 'leads.source_id', '=', 'lead_sources.id')
    ->leftJoin('lead_statues', 'leads.lead_status_id', '=', 'lead_statues.id')
    ->leftJoin('users', 'leads.user_id', '=', 'users.id');


    // Filtreleme
    if ($request->search_id) {
        $query->where('leads.id', $request->search_id);
    }
    if ($request->search_fullname) {
        $query->where('leads.fullname', 'like', '%' . $request->search_fullname . '%');
    }
    if ($request->search_phone) {
        $query->where('leads.phone', 'like', '%' . $request->search_phone . '%');
    }
    if ($request->search_gender_id) {
        $query->where('leads.gender_id', $request->search_gender_id);
    }
    if ($request->search_service_id) {
        $query->where('leads.service_id', $request->search_service_id);
    }
    if ($request->search_source_id) {
        $query->where('leads.source_id', $request->search_source_id);
    }
    if ($request->search_lead_status_id) {
        $query->where('leads.lead_status_id', $request->search_lead_status_id);
    }
    if ($request->search_user_id) {
        $query->where('leads.user_id', $request->search_user_id);
    }

    $leads = $query->get();

    return response()->json($leads);
    }
    // Lead Düzenleme Sayfası
    public function edit($id)
    {
        $lead = Lead::find($id);
        $sources = LeadSource::all();
        $services = Service::all();
        return view('leads.edit',compact('lead','sources','services'));
    }


}
