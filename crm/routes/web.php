<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\SmsLogController;
use App\Http\Controllers\LeadActivityController;
use App\Http\Controllers\LeadCallLogController;

Route::get('/', function () {
    return view('dashboard');
});


Route::get('/leads/view', [LeadController::class,'view'])->name('leads.view');
Route::get('/leads/index', [LeadController::class,'index'])->name('leads.index');
Route::get('/leads/edit/{id}', [LeadController::class,'edit'])->name('leads.edit');
Route::post('/leads/update', [LeadController::class,'update'])->name('leads.update');

Route::get('/leads/create', [LeadController::class,'create'])->name('leads.create');
Route::get('/leads/status-list', [LeadController::class,'status'])->name('leads.status');
Route::get('/leads/sources-list', [LeadController::class,'leadSources'])->name('leads.leadSources');
Route::get('/leads/report', [LeadController::class,'miniReport'])->name('leads.miniReport');
Route::post('/leads/assignment-update', [LeadController::class,'assignUserChange'])->name('lead.assign.user');
Route::post('/leads/file-upload', [LeadController::class,'leadFileUpload'])->name('leads.file.upload');

Route::post('/leads/store', [LeadController::class,'store'])->name('leads.store');
Route::get('/leads/fetch', [LeadController::class,'fetch'])->name('leads.fetch');


Route::post('/lead-activity/store',[LeadActivityController::class,'store'])->name('lead.activity.store');


Route::post('/sms/store',[SmsLogController::class,'store'])->name('sms.store');


Route::post('/lead/call-log', [LeadCallLogController::class, 'logOutgoingCall'])->name('lead.call.log');
