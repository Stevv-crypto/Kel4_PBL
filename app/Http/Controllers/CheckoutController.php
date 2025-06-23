<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function showCheckout(Request $request)
    {
        $user = Auth::user();

        // Redirect jika data user belum lengkap
        if (!$user->address || !$user->phone) {
            return redirect()->route('profile')->with('error', 'Lengkapi profil Anda sebelum checkout.');
        }

        $userEmail = $user->email;
        $selectedItems = $request->input('selected_items', []); // array dari checkbox

        if (empty($selectedItems)) {
            return redirect()->route('cart')->with('error', 'Pilih item terlebih dahulu.');
        }

        $cart = Cart::with('product')
            ->where('user_email', $userEmail)
            ->whereIn('code_cart', $selectedItems)
            ->get();

        if ($cart->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Item tidak ditemukan.');
        }

        $total = $cart->sum('subtotal');
        $paymentMethods = Payment::all();

        return view('pages.pembeli.checkout', [
            'user' => $user,
            'cart' => $cart,
            'total' => $total,
            'paymentMethods' => $paymentMethods,
        ]);
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|integer|exists:payments,id',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'selected_items' => 'required|array|min:1', // pastikan item dipilih
            'selected_items.*' => 'exists:carts,code_cart',
        ]);

        $payment = Payment::findOrFail($request->payment_method);

        $user = Auth::user();
        $selectedItems = $request->input('selected_items', []);

        // Ambil item dari keranjang berdasarkan pilihan user
        $cartItems = Cart::with('product')
            ->where('user_email', $user->email)
            ->whereIn('code_cart', $selectedItems)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Item yang dipilih tidak valid.');
        }

        $total = $cartItems->sum('subtotal');
        $orderCode = 'ORD-' . strtoupper(Str::random(10));

        // Simpan file bukti pembayaran
        //$file = $request->file('payment_proof');
        //$fileName = time() . '_' . $file->getClientOriginalName();
        //$filePath = $file->storeAs('public/payment_proofs', $fileName);
        // Simpan bukti pembayaran
        $imagePath = $request->file('payment_proof')->store('payment_proofs', 'public');


        // Simpan order ke tabel `orders`
        $order = Order::create([
            'order_code' => $orderCode,
            'user_id' => $user->id,
            'payment_id' => $request->payment_method,
            'total_price' => $total,
            'status' => 'waiting',
            //'payment_proof' => 'payment_proofs/' . $fileName,
            'payment_proof' => $imagePath,
        ]);


        // Simpan item pesanan ke tabel `order_items`
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_code' => $orderCode,
                'code_product' => $item->code_product,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
                'subtotal' => $item->subtotal,
            ]);
        }

        // Hapus item yang sudah diorder dari keranjang (bukan semua!)
        Cart::whereIn('code_cart', $selectedItems)->delete();
        return redirect()->route('invoice.show', ['order_code' => $order->order_code]);

    }
    
}
