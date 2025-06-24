<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesReport;

class SalesReportController extends Controller
{
    public function index()
    {
        $sales = SalesReport::orderBy('date', 'desc')->get();

        // Decode JSON field agar mudah diakses di blade
        foreach ($sales as $report) {
            $report->category = json_decode($report->category, true);
            $report->merk = json_decode($report->merk, true);
        }

        return view('pages.admin.sales-report', compact('sales'));
    }
}
