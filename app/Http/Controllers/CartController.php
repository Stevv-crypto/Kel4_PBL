<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;

class CartController extends Controller
{
    public function __construct()
    {
        // Semua method butuh user login
        $this->middleware('auth');
    }

    // Tambah produk ke keranjang
    public function addToCart(Request $request, $code_product)
    {
        //dd(Auth::check(), Auth::user());
        $product = Product::where('code_product', $code_product)->first();
        dd(Auth::check(), Auth::user());
        if (!$product) {
            return $request->wantsJson()
                ? response()->json(['message' => 'Produk tidak ditemukan.'], 404)
                : redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        $quantity = (int) $request->input('quantity', 1);
        $subtotal = $product->price * $quantity;
        $userEmail = Auth::user()->email;

        $existing = Cart::where('code_product', $code_product)
            ->where('user_email', $userEmail)
            ->first();

        if ($existing) {
            $existing->quantity += $quantity;
            $existing->subtotal = $existing->quantity * $product->price;
            $existing->save();
        } else {
            Cart::create([
                'code_cart' => Str::uuid(),
                'user_email' => $userEmail,
                'code_product' => $code_product,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ]);
        }

        return $request->wantsJson()
            ? response()->json(['message' => 'Produk berhasil ditambahkan ke keranjang.'])
            : redirect()->route('cart')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    // Tampilkan isi keranjang
    public function showCart()
    {
        $userEmail = Auth::user()->email;

        $cartItems = Cart::with('product')
            ->where('user_email', $userEmail)
            ->get();

        return view('pages.pembeli.cart', ['cart' => $cartItems]);
    }

    // Update jumlah produk di keranjang
    public function updateCart(Request $request, $code_product)
    {
        $userEmail = Auth::user()->email;

        $cart = Cart::where('code_product', $code_product)
            ->where('user_email', $userEmail)
            ->first();

        if ($cart) {
            $quantity = (int) $request->input('quantity', 1);
            $cart->quantity = $quantity;
            $cart->subtotal = $quantity * $cart->product->price;
            $cart->save();
        }

        return redirect()->route('cart')->with('success', 'Keranjang diperbarui.');
    }

    // Hapus produk dari keranjang
    public function removeFromCart($code_product)
    {
        $userEmail = Auth::user()->email;

        $cart = Cart::where('code_product', $code_product)
            ->where('user_email', $userEmail)
            ->first();

        if ($cart) {
            $cart->delete();
        }

        return redirect()->route('cart')->with('success', 'Produk dihapus dari keranjang.');
    }

    // Proses checkout dengan item terpilih
    public function goToCheckout(Request $request)
    {
        $request->validate([
            'selected_items' => 'required|array',
        ]);

        $userEmail = Auth::user()->email;
        $selectedItems = $request->input('selected_items');

        $cartItems = Cart::with('product')
            ->where('user_email', $userEmail)
            ->whereIn('code_cart', $selectedItems)
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Tidak ada item yang dipilih.');
        }

        $total = $cartItems->sum('subtotal');
        $user = Auth::user();

        return view('pages.pembeli.checkout', [
            'cartItems' => $cartItems,
            'total' => $total,
            'user' => $user,
        ]);
    }
}
