<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\SmsLogController;
use App\Http\Controllers\LeadActivityController;
use App\Http\Controllers\ProcessLogController;
use App\Http\Controllers\LeadCallLogController;
use App\Http\Controllers\FinanceContoller;
use App\Http\Controllers\PatientCallLogController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\SurgeryAppointmentController;
use App\Http\Controllers\PreAppointmentController;

Route::get('/', function () {
    return view('dashboard');
});
// Lead Routes
Route::get('/leads/view', [LeadController::class,'view'])->name('leads.view');
Route::get('/leads/index', [LeadController::class,'index'])->name('leads.index');
Route::get('/leads/edit/{id}', [LeadController::class,'edit'])->name('leads.edit');
Route::post('/leads/update', [LeadController::class,'update'])->name('leads.update');
Route::get('/leads/create', [LeadController::class,'create'])->name('leads.create');
Route::get('/leads/report', [LeadController::class,'miniReport'])->name('leads.miniReport');
Route::post('/leads/assignment-update', [LeadController::class,'assignUserChange'])->name('lead.assign.user');
Route::post('/leads/file-upload', [LeadController::class,'leadFileUpload'])->name('leads.file.upload');
Route::post('/leads/delete', [LeadController::class, 'delete'])->name('lead.delete');
Route::post('/leads/store', [LeadController::class,'store'])->name('leads.store');
Route::get('/leads/fetch', [LeadController::class,'fetch'])->name('leads.fetch');
Route::get('/lead/file/download/{id}', [LeadController::class, 'download'])->name('lead.file.download');
// Lead Aktivity Routes
Route::post('/lead-activity/store',[LeadActivityController::class,'store'])->name('lead.activity.store');
// SMS Log Routes
Route::post('/sms/store',[SmsLogController::class,'store'])->name('sms.store');
Route::post('/sms/patient-store',[SmsLogController::class,'patientSmsStore'])->name('sms.patient.store');
// Lead Call Log Routes
Route::post('/lead/call-log', [LeadCallLogController::class, 'logOutgoingCall'])->name('lead.call.log');
// Data (Hasta) Routes
Route::get('/data/view', [DataController::class,'view'])->name('data.view');
Route::get('/data/create', [DataController::class,'create'])->name('data.create');
Route::get('/data/fetch', [DataController::class,'fetch'])->name('data.fetch');
Route::get('/data/edit/{id}', [DataController::class,'edit'])->name('data.edit');
Route::post('/data/store', [DataController::class,'store'])->name('data.store');
Route::post('/data/update', [DataController::class,'update'])->name('data.update');
Route::get('/data/index', [DataController::class,'index'])->name('data.index');
Route::get('/data/detail/{id}', [DataController::class,'detail'])->name('data.detail');
Route::get('/data/report', [DataController::class,'miniReport'])->name('data.miniReport');
Route::post('/data/delete', [DataController::class, 'delete'])->name('data.delete');
// Data İşlem Routes
Route::post('/data/process/store', [ProcessLogController::class,'store'])->name('process.store');
Route::post('/data/operation/store', [SurgeryAppointmentController::class,'store'])->name('operation.store');
// Data Call Log Routes
Route::post('/patient/call-log', [PatientCallLogController::class, 'logOutgoingCall'])->name('patient.call.log');
// Metting Routes
Route::get('/meeting/view', [MeetingController::class,'view'])->name('meeting.view');
Route::get('/meeting/operation/view', [MeetingController::class,'operationView'])->name('meeting.operationView');
Route::get('/meeting/calendar/view', [MeetingController::class,'calendarView'])->name('meeting.calendarView');
Route::get('/meeting/appointment/view', [MeetingController::class,'appointmentView'])->name('meeting.appointmentView');
// PreAppointment Routes
Route::post('/pre-appointment/store', [PreAppointmentController::class,'store'])->name('preappointment.store');
Route::get('/pre-appointment/fetch', [PreAppointmentController::class,'fetch'])->name('preappointment.fetch');
Route::post('/pre-appointment/update', [PreAppointmentController::class,'statusUpdate'])->name('preappointment.update');
// Operasyon Rotası
Route::get('/operations/fetch', [OperationController::class,'fetch'])->name('operations.fetch');
// Finans Rotaları
Route::get('/finance/view', [FinanceContoller::class,'view'])->name('finance.view');
Route::get('/finance/send-payment', [FinanceContoller::class,'sendPayment'])->name('finance.sendPayment');
Route::post('/finance/send-payment-post', [FinanceContoller::class,'sendPaymentStore'])->name('finance.sendPayment.post');
Route::get('/finance/create-payment', [FinanceContoller::class,'createPayment'])->name('finance.createPayment');
Route::get('/finance/payments/fetch', [FinanceContoller::class, 'fetch'])->name('payment.fetch');
Route::post('/payments/update-status', [FinanceContoller::class, 'paymentStatusUpdate'])->name('payment.status.update');



