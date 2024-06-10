<?php

use App\Http\Controllers\PDFController;
use App\Livewire\FamilyReport;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

Route::get('/family-report/{family}', FamilyReport::class)->name("family-report");

Route::get('/', function () {
    return view('welcome');
});

Route::get("/pdf/family-report/{family}", [PDFController::class, "family_report"]);

// Livewire::setUpdateRoute(function ($handle) {
//     return Route::post('/public/livewire/update', $handle);
// });
