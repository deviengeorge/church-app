<?php

use App\Http\Controllers\PDFController;
use App\Livewire\FamilyReport;
use Illuminate\Support\Facades\Route;

Route::get('/family-report/{family}', FamilyReport::class)->name("family-report");

Route::get('/', function () {
    return view('welcome');
});

Route::get("/pdf/family-report/{family}", [PDFController::class, "family_report"]);
