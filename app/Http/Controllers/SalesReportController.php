<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Category;

class SalesReportController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        // Ambil OrderItem yang memiliki order dengan status 'completed'
        $query = OrderItem::with(['product.category', 'product.merk', 'order'])
            ->whereHas('order', function ($q) {
                $q->where('status', 'complete');
            });

        // Filter tanggal jika diisi
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereHas('order', function ($q) use ($request) {
                $q->whereDate('created_at', '>=', $request->start_date)
                  ->whereDate('created_at', '<=', $request->end_date);
            });
        }

        // Filter kategori jika diisi
        if ($request->filled('category')) {
            $query->whereHas('product.category', function ($q) use ($request) {
                $q->where('code', $request->category);
            });
        }

        // Ambil data akhir
        $sales = $query->get();

        return view('pages.admin.sales-report', compact('sales', 'categories'));
    }
}
