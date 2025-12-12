<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Patient;
use App\Models\LeadCallLog;
use App\Models\PatientCallLog;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardContoller extends Controller
{
    public function index()
    {
       
        // Bugün gelen lead
        $todayLeads = Lead::whereDate('created_at', Carbon::today())->count();
        // Dönüşen lead (hasta olanlar)
        $convertedLeads = Patient::whereYear('created_at', Carbon::now()->year)->count();
        // Bugünkü Aramalar
        $dailyCalls = LeadCallLog::whereDate('created_at', Carbon::today())->count()
                     + PatientCallLog::whereDate('created_at', Carbon::today())->count();
        // Bekleyen Ödeme
        $pendingPayments = Payment::where('payment_status', 'Beklemede')->count();
        $leadSources = Lead::select('source_id', DB::raw('COUNT(*) as total'))
            ->groupBy('source_id')
            ->get();
        $monthlyLeads = Lead::select(
                DB::raw("MONTH(created_at) as month"),
                DB::raw("COUNT(*) as total")
            )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $callStatuses = LeadCallLog::select('call_status', DB::raw('COUNT(*) as total'))
            ->groupBy('call_status')
            ->get();
        $paymentStatus = Payment::select('payment_status', DB::raw('COUNT(*) as total'))
            ->groupBy('payment_status')
            ->get();
        return view('dashboard', [
            'todayLeads'        => $todayLeads,
            'convertedLeads'    => $convertedLeads,
            'dailyCalls'        => $dailyCalls,
            'pendingPayments'   => $pendingPayments,
            'leadSources'       => $leadSources,
            'monthlyLeads'      => $monthlyLeads,
            'callStatuses'      => $callStatuses,
            'paymentStatus'     => $paymentStatus,
        ]);
    }
}
