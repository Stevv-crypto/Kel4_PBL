<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function tampilHome() {
        $featuredProducts = [
            [
                'id' => 1,
                'image_path' => 'image/12.png',
                'name' => 'Fan',
                'price' => 100000,
            ],
            [
                'id' => 2,
                'image_path' => 'image/13.png',
                'name' => 'Fan',
                'price' => 120000,
            ],
            [
                'id' => 2,
                'image_path' => 'image/13.png',
                'name' => 'Fan',
                'price' => 120000,
            ],
            [
                'id' => 2,
                'image_path' => 'image/13.png',
                'name' => 'Fan',
                'price' => 120000,
            ],
            [
                'id' => 2,
                'image_path' => 'image/13.png',
                'name' => 'Fan',
                'price' => 120000,
            ],
            [
                'id' => 2,
                'image_path' => 'image/13.png',
                'name' => 'Fan',
                'price' => 120000,
            ],
            [
                'id' => 2,
                'image_path' => 'image/13.png',
                'name' => 'Fan',
                'price' => 120000,
            ],
            [
                'id' => 2,
                'image_path' => 'image/13.png',
                'name' => 'Fan',
                'price' => 120000,
            ],
            [
                'id' => 2,
                'image_path' => 'image/13.png',
                'name' => 'Fan',
                'price' => 120000,
            ],
            [
                'id' => 2,
                'image_path' => 'image/13.png',
                'name' => 'Fan',
                'price' => 120000,
            ],
            [
                'id' => 2,
                'image_path' => 'image/13.png',
                'name' => 'Fan',
                'price' => 120000,
            ],
            [
                'id' => 2,
                'image_path' => 'image/13.png',
                'name' => 'Fan',
                'price' => 120000,
            ],
        ];

        return view('pages.pembeli.home_page', compact('featuredProducts'));
    }

    public function tampilKategori(Request $request) {
        $category = $request->query('category', 'Umum'); 

        $products = [
            [
                'id' => 1,
                'image_path' => 'image/20.png',
                'name' => $category . ' - television',
                'price' => 900000,
            ],
            [
                'id' => 2,
                'image_path' => 'image/20.png',
                'name' => $category . ' - washing-machine',
                'price' => 750000,
            ],
        ];

        return view('pages.pembeli.category', compact('products', 'category'));
    }
}
