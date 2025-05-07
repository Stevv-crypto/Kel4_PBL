<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Tampilkan halaman profile
    public function profile()
    {
        return view('pages.pembeli.profile');
    }
   
}
