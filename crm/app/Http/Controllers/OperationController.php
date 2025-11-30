<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OperationController extends Controller
{
    // Ameliyat Operasyonlarını Listele (Query Builder ile, joinli)
    public function fetch()
    {
        try {

            $appointments = DB::table('surgery_appointments as sa')
                ->leftJoin('patients as p', 'sa.patient_id', '=', 'p.id')
                ->leftJoin('doctors as d', 'sa.doctor_id', '=', 'd.id')
                 ->leftJoin('services as s', 'sa.surgery_type_id', '=', 's.id')
                ->select(
                    'sa.id',
                    'sa.scheduled_at',
                    'sa.status_id as status_id',
                    'p.fullname as patient_name',
                    'd.fullname as doctor_name',
                    's.name as service_name',
                    'sa.operation_room_id as room_id',
                    'sa.notes'
                )
                ->orderBy('sa.scheduled_at', 'desc')
                ->get();

            return response()->json([
                'data' => $appointments
            ]);

        } catch (\Throwable $e) {

            Log::error('Fetch SurgeryAppointments Error: ' . $e->getMessage(), [
                'file'  => $e->getFile(),
                'line'  => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Ameliyat randevuları listelenirken bir hata oluştu.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
