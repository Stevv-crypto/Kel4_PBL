<?php

namespace App\Models;

class Product
{
    // Data produk statis dengan kategori, stok, deskripsi, material, dan feature
    private static $products = [
        [
            'id' => 1,
            'image_path' => 'image/12.png',
            'name' => 'Fan',
            'price' => 400000,
            'category' => 'Fan',           // Kategori produk
            'stock' => 15,                 // Stok produk
            'description' => 'Fan listrik dengan kecepatan tinggi untuk mendinginkan ruangan.', // Deskripsi produk
            'material' => 'Plastik dan logam', // Material produk
            'feature' => 'Kecepatan angin dapat diatur, hemat energi' // Fitur produk
        ],
        [
            'id' => 2,
            'image_path' => 'image/3.png',
            'name' => 'TV-Samsung',
            'price' => 3000000,
            'category' => 'Television',    // Kategori produk
            'stock' => 10,                 // Stok produk
            'description' => 'Televisi Samsung dengan resolusi 4K dan teknologi pintar.', // Deskripsi produk
            'material' => 'Kaca dan plastik', // Material produk
            'feature' => 'Resolusi 4K, Smart TV, Wi-Fi built-in' // Fitur produk
        ],
        [
            'id' => 3,
            'image_path' => 'image/4.png',
            'name' => 'SHARP LED TV 24 Inch Digital DVB T2 HD USB HDMI ',
            'price' => 2500000,
            'category' => 'Television',    // Kategori produk
            'stock' => 8,                  // Stok produk
            'description' => 'SHARP LED TV 24 Inch HD Digital hadir dengan display berukuran 24 Inch yang memanjakan Anda. Dengan resolusi 1366 x 768 HD Ready menampilkan warna yang tajam dan terang. Anda dapat menyambungkan dengan perangkat lainnya menggunakan HDMI atau USB.', // Deskripsi produk
            'material' => 'Kaca dan plastik', // Material produk
            'feature' => '- Engine : X2 Master Engine
            - Display : LED
            - Resolusi : 1366 x 768 HD Ready
            - HDMI : 2 (HDMI 1.4)
            - USB : 2 (USB 2.0)
            - Jaringan : Wi-Fi, Bluetooth
            - Sistem Operasi : Android 9.0 Pie'
        ],
        [
            'id' => 4,
            'image_path' => 'image/6.png',
            'name' => 'Dispenser-Sharp',
            'price' => 1200000,
            'category' => 'Dispensers',    // Kategori produk
            'stock' => 20,                 // Stok produk
            'description' => 'Dispenser air Sharp dengan fungsi pemanas dan pendingin.', // Deskripsi produk
            'material' => 'Stainless', // Material produk
            'feature' => 'Pemanas dan pendingin air, desain modern' // Fitur produk
        ],
        [
            'id' => 5,
            'image_path' => 'image/8.png',
            'name' => 'Dispenser-Philips',
            'price' => 1500000,
            'category' => 'Dispensers',    // Kategori produk
            'stock' => 12,                 // Stok produk
            'description' => 'Dispenser air Philips dengan desain modern dan efisiensi energi.', // Deskripsi produk
            'material' => 'Stainless', // Material produk
            'feature' => 'Desain efisien, hemat energi, cocok untuk rumah tangga' // Fitur produk
        ],
    ];

    // Ambil semua produk
    public static function all()
    {
        return collect(self::$products);
    }

    // Cari produk berdasarkan ID
    public static function findOrFail($id)
    {
        $product = collect(self::$products)->firstWhere('id', $id);

        if (!$product) {
            abort(404, 'Product not found.');
        }

        return $product;
    }
}
