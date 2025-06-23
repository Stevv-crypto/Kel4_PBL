<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Menampilkan daftar semua order
    public function index()
    {
        $orders = Order::with(['user', 'payment', 'orderItems.product'])->get();
        return view('pages.admin.order', compact('orders'));
    }

    // Konfirmasi pesanan (ubah status menjadi 'sent')
    public function confirm(Order $order)
    {
        $order->status = 'sent';
        $order->save();

        return redirect()->route('order')->with('success', 'Order confirmed successfully.');
    }

    // Tolak pesanan (ubah status menjadi 'rejected')
    public function reject(Order $order)
    {
        $order->status = 'rejected';
        $order->save();

        return redirect()->route('order')->with('error', 'Order rejected.');
    }

    public function updateStatus(Request $request, Order $order)
{
    $validated = $request->validate([
        'status' => 'required|in:processing,sent,complete,rejected',
    ]);

    $order->status = $validated['status'];
    $order->save();

    return redirect()->back()->with('success', 'Order status updated.');
}
}
