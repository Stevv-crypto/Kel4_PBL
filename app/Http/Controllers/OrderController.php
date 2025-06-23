<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;


class OrderController extends Controller
{
    // Tampilkan halaman order list
    public function order()
    {
        // Kalau pakai database, bisa ambil data dari model Order:
        // $orders = Order::all();

        // Sekarang karena datanya masih di client-side (Alpine.js), kita cukup return view
        return view('pages.admin.order');
    }
    // Tampilkan detail 1 order
    public function show(Order $order)
    {
        $order->load('user', 'orderItems', 'payment');
        return view('components.admin.header', compact('order'));
    }

    // Konfirmasi pesanan
    public function confirm(Order $order)
    {
        if ($order->status === 'waiting') {
            $order->status = 'processing';
            $order->save();
        }

        return redirect()->back()->with('success', 'Order berhasil dikonfirmasi.');
    }

    // Tolak pesanan
    public function reject(Order $order)
    {
        if ($order->status === 'waiting') {
            $order->status = 'rejected';
            $order->save();
        }

        return redirect()->back()->with('error', 'Order telah ditolak.');
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return response()->json(['message' => 'Status updated successfully']);
    }
}
