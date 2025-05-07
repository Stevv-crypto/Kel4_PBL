<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/product', [productController::class, 'tampilProduk'
])->name('products');

Route::get('/home_page', [ProductController::class, 'tampilHome'])->name('home_page');;
Route::get('category', [ProductController::class, 'tampilKategori'])->name('category');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/category', [ProductController::class, 'tampilKategori'])->name('tampilKategori');