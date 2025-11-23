<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;


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
        return view('data.create');
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
        return view('data.index');
    }

    // Hasta Detay Sayfası
    public function detail($id)
    {
        return view('data.detail');
    }

    // Hasta Mini Rapor Sayfası
    public function miniReport(){
        return view('data.reports-data');
    }

}
