<?php

namespace App\Http\Controllers;

use App\Livewire\FamilyReport;
use App\Models\Family;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function family_report(Family $family)
    {
        return view("pdf.family-report", ["family" => $family]);
        // return Pdf::loadView('pdf.family-report', ['family' => $family]);
    }
}
