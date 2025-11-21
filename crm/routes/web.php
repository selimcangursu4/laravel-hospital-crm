<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;

Route::get('/', function () {
    return view('dashboard');
});


Route::get('/leads/view', [LeadController::class,'view'])->name('leads.view');
