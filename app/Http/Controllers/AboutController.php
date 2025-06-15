<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about()
    {
        // Company Description Image
        $welcomeImage = 'images/company-electronics.jpg'; // Pastikan file ini ada di public/images/

        return view('pages.pembeli.about', compact('welcomeImage'));
    }
}
