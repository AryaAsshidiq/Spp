<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\FinancialSummary;
use Carbon\Carbon;

class FinancialSummaryController extends Controller
{
    public function index(Request $request)
    {
        $monthYear = $request->input('month_year');
    
        $financialSummaries = FinancialSummary::query();
    
        if ($monthYear) {
            // Parsing month and year from input
            $parsedDate = Carbon::parse($monthYear);
            $financialSummaries->whereYear('summary_date', $parsedDate->year)
                               ->whereMonth('summary_date', $parsedDate->month);
        }
    
        $financialSummaries = $financialSummaries->orderBy('summary_date')->get();
    
        return view('admin.financial.index', compact('financialSummaries', 'monthYear'));
    }

    public function print(Request $request)
    {
        $monthYear = $request->input('month_year');
    
        $financialSummaries = FinancialSummary::query();
    
        if ($monthYear) {
            $date = Carbon::parse($monthYear);
            $financialSummaries->whereYear('summary_date', $date->year)
                               ->whereMonth('summary_date', $date->month);
        }
    
        $financialSummaries = $financialSummaries->orderBy('summary_date')->get();
        $total_income = $financialSummaries->sum('total_income');
    
        // Load view PDF and send for download
        $pdf = PDF::loadView('admin.financial.pdf', compact('financialSummaries', 'monthYear', 'total_income'));
        return $pdf->download('rekap_keuangan_' . ($monthYear ? $date->format('Y-m') : 'all') . '.pdf');
    }    
}
