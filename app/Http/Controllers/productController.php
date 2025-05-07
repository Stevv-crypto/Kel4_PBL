<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

class ProductController extends Controller
{
    public function tampilHome() {
        $featuredProducts = [
            [
                'id' => 1,
                'image_path' => 'image/12.png',
                'name' => 'Fan',
                'price' => 400000,
            ],
            [
                'id' => 2,
                'image_path' => 'image/3.png',
                'name' => 'TV-Samsung',
                'price' => 3000000,
            ],
            [
                'id' => 3,
                'image_path' => 'image/4.png',
                'name' => 'TV-LG',
                'price' => 2500000,
            ],
            [
                'id' => 4,
                'image_path' => 'image/6.png',
                'name' => 'Dispenser-Sharp',
                'price' => 1200000,
            ],
            [
                'id' => 5,
                'image_path' => 'image/8.png',
                'name' => 'Dispenser-Philips',
                'price' => 1500000,
            ],
        ];

        return view('pages.pembeli.home_page', compact('featuredProducts'));
    }

    public function showCategory($category)
    {
        $products = Product::all()->filter(function ($product) use ($category) {
            return strtolower($product['category']) === strtolower($category);
        });
        
        return view('pages.pembeli.category', compact('products', 'category'));
    }

    public function show($id)
{
    $product = product::findOrFail($id);
    return view('pages.pembeli.detail_product', compact('product'));
}

}
