<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class loginController extends Controller
{
    // Menampilkan halaman login
    public function tampilLogin() {
        return view('pages.pembeli.login');
    }
}
