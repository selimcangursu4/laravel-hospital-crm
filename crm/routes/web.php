<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;

Route::get('/', function () {
    return view('dashboard');
});


Route::get('/leads/view', [LeadController::class,'view'])->name('leads.view');
Route::get('/leads/index', [LeadController::class,'index'])->name('leads.index');
Route::get('/leads/create', [LeadController::class,'create'])->name('leads.create');
Route::get('/leads/status-list', [LeadController::class,'status'])->name('leads.status');
Route::get('/leads/sources-list', [LeadController::class,'leadSources'])->name('leads.leadSources');
Route::get('/leads/report', [LeadController::class,'miniReport'])->name('leads.miniReport');


Route::post('/leads/store', [LeadController::class,'store'])->name('leads.store');
