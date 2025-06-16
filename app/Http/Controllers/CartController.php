<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Payment;
use App\Models\User;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Tambah produk ke keranjang
    public function addToCart(Request $request, $code_product)
    {
        $product = Product::where('code_product', $code_product)->first();

        if (!$product) {
            return $request->wantsJson()
                ? response()->json(['message' => 'Produk tidak ditemukan.'], 404)
                : redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        $quantity = max((int) $request->input('quantity', 1), 1);

        $stock = $product->stock;

        if (!$stock || $stock->stock < $quantity) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
        }

        $userEmail = Auth::user()->email;
        $subtotal = $product->price * $quantity;

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

        // Kurangi stok
        $stock->stock -= $quantity;
        $stock->save();

        $cartCount = Cart::where('user_email', $userEmail)->count();

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Produk berhasil ditambahkan ke keranjang.',
                'cartCount' => $cartCount,
            ]);
        }

        return redirect()->route('cart')->with('success', 'Produk ditambahkan ke keranjang.');
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

        $cart = Cart::with('product.stock')
            ->where('code_product', $code_product)
            ->where('user_email', $userEmail)
            ->first();

        if ($cart) {
            $quantity = max((int) $request->input('quantity', 1), 1);
            $stock = $cart->product->stock;

            if (!$stock) {
                return redirect()->route('cart')->with('error', 'Stok tidak tersedia.');
            }

            $totalAvailable = $stock->stock + $cart->quantity;

            if ($quantity > $totalAvailable) {
                return redirect()->route('cart')->with('error', 'Stok tidak mencukupi untuk update.');
            }

            // Kembalikan stok sebelumnya
            $stock->stock += $cart->quantity;

            // Update cart
            $cart->quantity = $quantity;
            $cart->subtotal = $quantity * $cart->product->price;
            $cart->save();

            // Kurangi stok sesuai update
            $stock->stock -= $quantity;
            $stock->save();
        }

        return redirect()->route('cart')->with('success', 'Keranjang diperbarui.');
    }

    // Hapus produk dari keranjang
    public function removeFromCart($code_product)
    {
        $userEmail = Auth::user()->email;

        $cart = Cart::with('product.stock')
            ->where('code_product', $code_product)
            ->where('user_email', $userEmail)
            ->first();

        if ($cart) {
            $stock = $cart->product->stock;

            if ($stock) {
                $stock->stock += $cart->quantity;
                $stock->save();
            }

            $cart->delete();
        }

        return redirect()->route('cart')->with('success', 'Produk dihapus dari keranjang.');
    }

}

