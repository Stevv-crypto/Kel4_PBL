<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Category;
use App\Models\Order;

class SalesReportController extends Controller
{
    public function index(Request $request)
{
    $categories = Category::all();

    $query = OrderItem::with(['product.category', 'product.merk', 'order']);

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereHas('order', function ($q) use ($request) {
            $q->whereDate('created_at', '>=', $request->start_date)
              ->whereDate('created_at', '<=', $request->end_date);
        });
    }

    if ($request->filled('category')) {
        $query->whereHas('product.category', function ($q) use ($request) {
            $q->where('code', $request->category);
        });
    }

    $sales = $query->get();

    return view('pages.admin.sales-report', compact('sales', 'categories'));
}

}
