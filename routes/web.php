<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DetailproductController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/product', [productController::class, 'tampilProduk'
])->name('products');

Route::get('/home_page', [ProductController::class, 'tampilHome'])->name('home_page');;
Route::get('category', [ProductController::class, 'tampilKategori'])->name('category');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/category', [ProductController::class, 'tampilKategori'])->name('tampilKategori');

Route::get('profile', function () {
    return view('pages/profile');
});
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');

Route::get('about', function () {
    return view('pages/about');
});
Route::get('/about', [AboutController::class, 'about'])->name('about');

Route::get('contact', function () {
    return view('pages/contact');
});
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::get('/detail_product', [DetailproductController::class, 'detail'])->name('detail_product');;
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');