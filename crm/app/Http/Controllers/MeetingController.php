<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeetingController extends Controller
{
    // Randevu ve Takvim View Sayfası
    public function view(){
        return view('meeting.view');
    }
    // Operasyon Ameliyat Sayfası
    public function operationView(){
        return view('meeting.operation');
    }
     // Takvim Sayfası
    public function calendarView(){
        return view('meeting.calendar');
    }
       // Muayene Sayfası
    public function appointmentView(){
        return view('meeting.appointment');
    }

}
