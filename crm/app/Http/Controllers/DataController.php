<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Patient;
use App\Models\Service;
use App\Models\LeadSource;
use App\Models\PatientStatus;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;



class DataController extends Controller
{
    // Hasta View Sayfası
    public function view()
    {
        return view('data.view');
    }
    // Yeni Hasta Ekleme Sayfası
    public function create()
    {
        $services = Service::all();
        $sources = LeadSource::all();
        return view('data.create', compact('services', 'sources'));
    }
    // Yeni Hasta Kaydetme İşlemi
    public function store(Request $request)
    {
        try {
            $fullname = $request->input('fullname');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $birthdate = $request->input('birthdate');
            $gender_id = $request->input('gender_id');
            $country_id = $request->input('country_id');
            $city_id = $request->input('country_id');
            $address = $request->input('address');
            $service_id = $request->input('service_id');
            $source_id = $request->input('source_id');
            $blood_group_id = $request->input('blood_group_id');
            $height = $request->input('height');
            $weight = $request->input('weight');
            $emergency_contact_phone = $request->input('emergency_contact_phone');

            $newPatient = new Patient();
            $newPatient->fullname = $fullname;
            $newPatient->email = $email;
            $newPatient->phone = $phone;
            $newPatient->birth_date = $birthdate;
            $newPatient->gender_id = $gender_id;
            $newPatient->address = $address;
            $newPatient->country_id = $country_id;
            $newPatient->city_id = $city_id;
            $newPatient->service_id = $service_id;
            $newPatient->source_id = $source_id;
            $newPatient->user_id = Auth::user()->id ?? 1;
            $newPatient->doctor_id = null;
            $newPatient->patient_status_id = 1;
            $newPatient->blood_type = $blood_group_id;
            $newPatient->height = $height;
            $newPatient->weight =  $weight;
            $newPatient->emergency_contact_name  = $emergency_contact_phone;
            $newPatient->save();

            return response()->json(['success' => true, 'message' => 'Hasta Başarıyla Kaydedildi.']);
        } catch (Exception $th) {
            return response()->json(['success' => false, 'message' => 'Hasta Kaydedilirken Bir Hata Oluştu: ' . $th->getMessage()]);
        }
    }
    // Hasta Listeleme Sayfası
    public function index()
    {
        $services = Service::all();
        $sources  = LeadSource::all();
        $statuses  = PatientStatus::all();
        $users = User::all();
        $doctors = Doctor::all();

        return view('data.index', compact('services', 'sources', 'statuses', 'users', 'doctors'));
    }
    // Hasta Detay Sayfası
    public function detail($id)
    {
        return view('data.detail');
    }
    // Hasta Mini Rapor Sayfası
    public function miniReport()
    {
        return view('data.reports-data');
    }
    // Tüm Hastaları Getirme (Filtreli)
    public function fetch(Request $request)
    {
        $query = Patient::select(
            'patients.id',
            'patients.fullname',
            'patients.phone',
            'patients.gender_id',
            'services.name as service_name',
            'lead_sources.name as source_name',
            'patient_statues.name as status_name',
            'users.name as user_name',
            'doctors.name as doctor_name'
        )
            ->leftJoin('services', 'patients.service_id', '=', 'services.id')
            ->leftJoin('lead_sources', 'patients.source_id', '=', 'lead_sources.id')
            ->leftJoin('patient_statues', 'patients.patient_status_id', '=', 'patient_statues.id')
            ->leftJoin('users', 'patients.user_id', '=', 'users.id')
            ->leftJoin('users as doctors', 'patients.doctor_id', '=', 'doctors.id');

        // Filtreleme
        if ($request->search_id) {
            $query->where('patients.id', $request->search_id);
        }
        if ($request->search_fullname) {
            $query->where('patients.fullname', 'like', '%' . $request->search_fullname . '%');
        }
        if ($request->search_phone) {
            $query->where('patients.phone', 'like', '%' . $request->search_phone . '%');
        }
        if ($request->search_gender_id) {
            $query->where('patients.gender_id', $request->search_gender_id);
        }
        if ($request->search_service_id) {
            $query->where('patients.service_id', $request->search_service_id);
        }
        if ($request->search_source_id) {
            $query->where('patients.source_id', $request->search_source_id);
        }
        if ($request->search_patient_status_id) {
            $query->where('patients.patient_status_id', $request->search_patient_status_id);
        }
        if ($request->search_user_id) {
            $query->where('patients.user_id', $request->search_user_id);
        }
        if ($request->search_doctor_id) {
            $query->where('patients.doctor_id', $request->search_doctor_id);
        }

        return response()->json($query->get());
    }
    // Hasta Edit Sayfası
    public function edit($id)
    {
        $patient = Patient::find($id)->first();
        $services = Service::all();
        $doctors = Doctor::all();

        return view('data.edit', compact('patient', 'services', 'doctors'));
    }
    public function update(Request $request)
    {
        try {
            // Patient ID al
            $id = $request->input('id');
            if (!$id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Patient ID boş.'
                ], 400);
            }

            // Patient bulun
            $patient = Patient::find($id);
            if (!$patient) {
                return response()->json([
                    'success' => false,
                    'message' => 'Hasta bulunamadı.'
                ], 404);
            }

            // Verileri güncelle
            $patient->fullname = $request->input('fullname');
            $patient->email = $request->input('email');
            $patient->phone = $request->input('phone');
            $patient->birth_date = $request->input('birth_date');
            $patient->gender_id = $request->input('gender_id');
            $patient->blood_type = $request->input('blood_type');
            $patient->height = $request->input('height');
            $patient->weight = $request->input('weight');
            $patient->country_id = $request->input('country_id');
            $patient->city_id = $request->input('city_id');
            $patient->address = $request->input('address');
            $patient->service_id = $request->input('service_id');
            $patient->doctor_id = $request->input('doctor_id');
            $patient->patient_status_id = $request->input('patient_status_id');
            $patient->emergency_contact_name = $request->input('emergency_contact_name');

            // Veritabanına kaydet
            $patient->save();

            return response()->json([
                'success' => true,
                'message' => 'Hasta bilgileri başarıyla güncellendi.'
            ]);
        } catch (\Throwable $th) {
            Log::error('Patient Update Error: ' . $th->getMessage(), [
                'trace' => $th->getTraceAsString(),
                'request' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Bir hata oluştu: ' . $th->getMessage()
            ], 500);
        }
    }
}
