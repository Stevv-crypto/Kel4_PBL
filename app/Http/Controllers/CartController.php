<?php
// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

class CartController extends Controller
{
    public function index()
    {
        return view('pages.pembeli.cart');
    }
    
    public function checkout() {
        return view('pages.pembeli.checkout'); // ini untuk halaman checkout
    }
}
