<?php

namespace App\Http\Controllers;
use App\Models\Lead;
use App\Models\LeadActivity;
use App\Models\LeadAssignmentLog;
use App\Models\LeadCallLog;
use App\Models\LeadFile;
use App\Models\Patient;
use App\Models\PatientCallLog;
use App\Models\PatientSmsLog;
use App\Models\ProcessLog;
use App\Models\SurgeryAppointment;
use App\Models\PreAppointment;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function view(Request $request)
    {
        $startDate = $request->input("start_date", now()->startOfMonth());
        $endDate = $request->input("end_date", now()->endOfDay());

        // Toplam hasta ve lead
        $totalPatients = DB::table("patients")
            ->whereBetween("created_at", [$startDate, $endDate])
            ->count();

        $totalLeads = DB::table("leads")
            ->whereBetween("created_at", [$startDate, $endDate])
            ->count();

        // Ödemeler
        $pendingPaymentsCount = DB::table("payment")
            ->where("payment_status", "Beklemede")
            ->whereBetween("created_at", [$startDate, $endDate])
            ->count();

        $completedPaymentsCount = DB::table("payment")
            ->where("payment_status", "Tamamlandı")
            ->whereBetween("created_at", [$startDate, $endDate])
            ->count();

        $expectedPaymentAmount = DB::table("payment")
            ->where("payment_status", "Beklemede")
            ->whereBetween("created_at", [$startDate, $endDate])
            ->sum("final_price");

        $totalRevenue = DB::table("payment")
            ->where("payment_status", "Tamamlandı")
            ->whereBetween("created_at", [$startDate, $endDate])
            ->sum("final_price");

        // Hasta analizleri
        $mostPatientGender = DB::table("patients")
            ->select("gender_id", DB::raw("count(*) as count"))
            ->whereBetween("created_at", [$startDate, $endDate])
            ->groupBy("gender_id")
            ->orderByDesc("count")
            ->value("gender_id");
        $mostPatientService = DB::table("patients")
            ->join("services", "patients.service_id", "=", "services.id")
            ->select("services.name", DB::raw("count(*) as count"))
            ->whereBetween("patients.created_at", [$startDate, $endDate])
            ->groupBy("services.name")
            ->orderByDesc("count")
            ->value("services.name");
        $mostPatientSource = DB::table("patients")
            ->join("lead_sources", "patients.source_id", "=", "lead_sources.id")
            ->select("lead_sources.name", DB::raw("count(*) as count"))
            ->whereBetween("patients.created_at", [$startDate, $endDate])
            ->groupBy("lead_sources.name")
            ->orderByDesc("count")
            ->value("lead_sources.name");

        $patientStatuses = DB::table("patients")
            ->join(
                "patient_statues",
                "patients.patient_status_id",
                "=",
                "patient_statues.id"
            )
            ->select("patient_statues.name", DB::raw("count(*) as count"))
            ->whereBetween("patients.created_at", [$startDate, $endDate])
            ->groupBy("patient_statues.name")
            ->pluck("count", "patient_statues.name");

        $topDataOwner = DB::table("patients")
            ->join("users", "patients.user_id", "=", "users.id")
            ->select("users.name", DB::raw("count(*) as count"))
            ->whereBetween("patients.created_at", [$startDate, $endDate])
            ->groupBy("users.name")
            ->orderByDesc("count")
            ->value("users.name");

        // Lead analizleri
        $leadGenderDistribution = DB::table("leads")
            ->select("gender_id", DB::raw("count(*) as count"))
            ->whereBetween("created_at", [$startDate, $endDate])
            ->groupBy("gender_id")
            ->orderByDesc("count")
            ->pluck("count", "gender_id");

        $leadServiceDistribution = DB::table("leads")
            ->join("services", "leads.service_id", "=", "services.id")
            ->select("services.name", DB::raw("count(*) as count"))
            ->whereBetween("leads.created_at", [$startDate, $endDate])
            ->groupBy("services.name")
            ->orderByDesc("count")
            ->pluck("count", "services.name");

        $leadSourceDistribution = DB::table("leads")
            ->join("lead_sources", "leads.source_id", "=", "lead_sources.id")
            ->select("lead_sources.name", DB::raw("count(*) as count"))
            ->whereBetween("leads.created_at", [$startDate, $endDate])
            ->groupBy("lead_sources.name")
            ->orderByDesc("count")
            ->pluck("count", "lead_sources.name");

        $leadStatusDistribution = DB::table("leads")
            ->join(
                "patient_statues",
                "leads.lead_status_id",
                "=",
                "patient_statues.id"
            )
            ->select("patient_statues.name", DB::raw("count(*) as count"))
            ->whereBetween("leads.created_at", [$startDate, $endDate])
            ->groupBy("patient_statues.name")
            ->orderByDesc("count")
            ->pluck("count", "patient_statues.name");

        $leadToPatientRow = DB::table("patients")
            ->join("users", "patients.user_id", "=", "users.id")
            ->select("users.name", DB::raw("count(patients.id) as count"))
            ->whereBetween("patients.created_at", [$startDate, $endDate])
            ->groupBy("users.name")
            ->orderByDesc("count")
            ->first();

        $leadToPatient = $leadToPatientRow ? $leadToPatientRow->name : null;

        return view(
            "reports.view",
            compact(
                "totalPatients",
                "totalLeads",
                "pendingPaymentsCount",
                "completedPaymentsCount",
                "expectedPaymentAmount",
                "totalRevenue",
                "mostPatientGender",
                "mostPatientService",
                "mostPatientSource",
                "patientStatuses",
                "topDataOwner",
                "leadGenderDistribution",
                "leadServiceDistribution",
                "leadSourceDistribution",
                "leadStatusDistribution",
                "leadToPatient",
                "startDate",
                "endDate"
            )
        );
    }
}
