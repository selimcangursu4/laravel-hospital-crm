<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\LeadSource;
use App\Models\LeadStatus;
use App\Models\Service;
use App\Models\User;
use App\Models\Lead;
use App\Models\LeadAssignmentLog;
use App\Models\LeadFile;
use Illuminate\Support\Facades\Storage;
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
        $statuses = LeadStatus::all();
        $users = User::all();
        return view('leads.edit',compact('lead','sources','services','statuses','users'));
    }
    // Lead Güncelleme Post İşlemi
    public function update(Request $request)
    {
      try {

        $leadId = $request->input('lead_id');
        $lead = Lead::find($leadId);

        if (!$lead) {
            Log::warning('Lead güncelleme denemesi başarısız: Lead bulunamadı.', [
                'lead_id' => $leadId,
                'request' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Lead bulunamadı.'
            ], 404);
        }
        $lead->fullname    = $request->input('fullname');
        $lead->email       = $request->input('email');
        $lead->phone       = $request->input('phone');
        $lead->birth_date  = $request->input('birth_date');
        $lead->gender_id   = $request->input('gender_id');
        $lead->country_id  = $request->input('country_id');
        $lead->city_id     = $request->input('city_id');
        $lead->service_id  = $request->input('service_id');
        $lead->source_id   = $request->input('source_id');
        $lead->save();

        Log::info('Lead başarıyla güncellendi.', [
            'lead_id' => $lead->id,
            'updated_by' => auth()->id(),
            'updated_fields' => $request->all()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Lead başarıyla güncellendi.'
        ], 200);

     } catch (\Throwable $th) {

        Log::error('Lead güncelleme hatası!', [
            'error_message' => $th->getMessage(),
            'lead_id' => $request->input('lead_id'),
            'request' => $request->all(),
            'trace' => $th->getTraceAsString()
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Lead güncellenirken bir hata oluştu.',
        ], 500);
      }
    }
    // Lead Personel Atama Değişikliği
    public function assignUserChange(Request $request)
    {
        try {
            $lead_id = $request->input('lead_id');
            $user_id = $request->input('user_id');
            $description = $request->input('description');

            $lead = Lead::find($lead_id);
            if ($lead) {
                $lead->user_id = $user_id;
                $lead->save();
            }

            $leadAssignmentLog = new LeadAssignmentLog();
            $leadAssignmentLog->lead_id = $lead_id;
            $leadAssignmentLog->assigned_by =$lead->user_id;
            $leadAssignmentLog->assigned_to = $user_id;
            $leadAssignmentLog->description = $description;
            $leadAssignmentLog->user_id = Auth::id() ?? 1;
            $leadAssignmentLog->save();


            return response()->json([
                'success' => true,
                'message' => 'Lead personel ataması başarıyla güncellendi.'
            ]);

        } catch (Exception $th) {
            Log::error('Lead personel atama hatası: ' . $th->getMessage(), [
                'request' => $request->all(),
                'trace' => $th->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Lead personel ataması güncellenirken bir hata oluştu.',
                'error' => $th->getMessage()
            ]);
        }
    }
    // Leade Ait Dosya Yükleme
    public function leadFileUpload(Request $request)
    {
      try {
        $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $lead_id = $request->input('lead_id');
        $file = $request->file('file');

        // Dosya adını benzersiz yap
        $fileName = time() . '_' . $file->getClientOriginalName();

        $directory = 'public/lead_files';

        // Eğer klasör yoksa oluştur
        if (!Storage::exists($directory)) {
         Storage::makeDirectory($directory);
        }

        // Dosyayı klasöre kaydet
        $filePath = $file->storeAs($directory, $fileName);

        // Veritabanına kaydet
        $leadFile = new LeadFile();
        $leadFile->lead_id = $lead_id;
        $leadFile->file_path = $filePath;
        $leadFile->original_name = $file->getClientOriginalName();
        $leadFile->uploaded_by = auth()->id() ?? 1;
        $leadFile->save();

        return response()->json([
            'success' => true,
            'message' => 'Dosya başarıyla yüklendi.',
            'file' => $leadFile
        ]);

       } catch (Exception $e) {
        Log::error('Lead dosya yükleme hatası: ' . $e->getMessage(), [
            'request' => $request->all(),
            'trace' => $e->getTraceAsString()
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Dosya yüklenirken bir hata oluştu: ' . $e->getMessage()
        ], 500);
     }
    }




}
