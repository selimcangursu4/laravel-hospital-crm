<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeadController extends Controller
{
    // Lead View Sayfası
    public function view()
    {
        return view('leads.view');
    }
}
