<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    // Tampilkan halaman checkout
    public function showCheckoutPage(Request $request)
    {
        $user = Auth::user();
        $userEmail = $user->email;

        $selectedIds = $request->input('selected_items', []);
        if (empty($selectedIds)) {
            return redirect()->route('cart')->with('error', 'Pilih item terlebih dahulu.');
        }

        $cartItems = Cart::with('product')
            ->where('user_email', $userEmail)
            ->whereIn('code_cart', $selectedIds)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Item tidak ditemukan.');
        }

        // Ambil data metode pembayaran dari database
        $payments = Payment::all();

        if (empty($user->address) || empty($user->phone)) {
            return view('pages.pembeli.checkout', [
                'cartItems' => collect(),
                'total' => 0,
                'user' => $user,
                'payments' => $payments,
                'showProfileAlert' => true,
            ]);
        }

        $total = $cartItems->sum('subtotal');

        return view('pages.pembeli.checkout', [
            'cartItems' => $cartItems,
            'total' => $total,
            'user' => $user,
            'payments' => $payments,
        ]);
    }

    // Proses submit checkout
    public function checkout(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userEmail = $user->email;

        $request->validate([
            'selected_items' => 'required|array',
            'payment_method' => 'required|in:Bank BNI,Bank Mandiri,OVO,DANA',
            'payment_proof'  => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $selectedIds = $request->input('selected_items');

        $cartItems = Cart::with('product')
            ->where('user_email', $userEmail)
            ->whereIn('code_cart', $selectedIds)
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Keranjang kosong atau item tidak ditemukan.');
        }

        // Mapping metode yang dikirim dari form ke method_name yang ada di database
        $methodMap = [
            'bni' => 'Bank BNI',
            'mandiri' => 'Bank Mandiri',
            'dana' => 'DANA',
            'ovo' => 'OVO',
        ];

        $methodName = $methodMap[$request->payment_method] ?? null;

        $payment = Payment::where('method_name', $methodName)->first();
        if (!$payment) {
            return back()->with('error', 'Metode pembayaran tidak ditemukan.');
        }

        // Upload bukti pembayaran jika tersedia
        $proofPath = null;
        if ($request->hasFile('payment_proof')) {
            $proofPath = $request->file('payment_proof')->store('public/payment_proofs');
        }

        // Generate kode pesanan unik
        $orderCode = strtoupper('ORD-' . Str::random(8));

        // Simpan data pesanan
        $order = Order::create([
            'order_code'     => $orderCode,
            'user_id'        => $user->id, // ✅ FIXED
            'total_price'    => $cartItems->sum('subtotal'),
            'payment_id'     => $payment->id,
            'payment_proof'  => $proofPath,
            'status'         => 'WAITING',
        ]);

        // Simpan item pesanan
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_code'   => $order->order_code,
                'code_product' => $item->code_product,
                'quantity'     => $item->quantity,
                'price'        => $item->product->price,
                'subtotal'     => $item->subtotal,
            ]);
        }

        // Hapus item yang telah dipesan dari keranjang
        Cart::where('user_email', $userEmail)
            ->whereIn('code_cart', $selectedIds)
            ->delete();
        

        return redirect()->route('home_page')->with('success', 'Pesanan berhasil dibuat!');
    }
}
