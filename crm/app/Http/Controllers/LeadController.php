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
    // Tüm Leadler Sayfası
    public function index()
    {
        return view('leads.index');
    }
    // Yeni Lead Oluşturma Sayfası
    public function create()
    {
        return view('leads.create');
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
}
