<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ViewAllController extends Controller
{
    public function tampilProduk()
    {
        // Ambil semua produk yang memiliki stok tersedia (> 0), beserta relasi kategori dan merk
        $dataProduk = Product::with(['category', 'merk', 'stock'])
            ->whereHas('stock', function ($query) {
                $query->where('stock', '>', 0);
            })
            ->get();

        return view('pages.pembeli.viewAll', compact('dataProduk'));
    }
}
