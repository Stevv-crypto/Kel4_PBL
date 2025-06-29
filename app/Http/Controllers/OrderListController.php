<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderListController extends Controller
{
    public function index()
    {
        $orders = Order::with(['orderItems.product.category', 'orderItems.product.merk'])
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('pages.pembeli.orderList', compact('orders'));
    }

    public function invoice($order_code)
{
    $order = Order::with(['user', 'payment'])->where('order_code', $order_code)->firstOrFail();
    $invoiceProducts = $order->orderItems()->with('product')->get();

    $subTotal = $invoiceProducts->sum('subtotal');

    return view('pages.pembeli.invoice', compact('order', 'invoiceProducts', 'subTotal'));
}

}
