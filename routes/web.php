<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DetailproductController;
use App\Http\Controllers\viewAllController;
use App\Http\Controllers\productController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\TimController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('profile', function () {
    return view('pages/profile');
});

Route::get('about', function () {
    return view('pages/about');
});

Route::get('contact', function () {
    return view('pages/contact');
});

Route::get('/login', [loginController::class, 'tampilLogin'])->name('login');
Route::get('/register', [RegisterController::class, 'tampilRegister'])->name('register');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::get('/detail_product', [DetailproductController::class, 'detail'])->name('detail_product');;
//Route::get('/cart', [CartController::class, 'index'])->name('cart'); gk dipakai
//Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout'); gk dipakai
Route::get('/home_page', [ProductController::class, 'tampilHome'])->name('home_page');;
Route::get('category', [ProductController::class, 'tampilKategori'])->name('category');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/category', [ProductController::class, 'tampilKategori'])->name('tampilKategori');
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
Route::get('/about', [AboutController::class, 'about'])->name('about');
Route::get('/product', [productController::class, 'tampilProduk'])->name('products');
Route::get('/viewAll', [viewAllController::class, 'tampilProduk'])->name('viewAll');
Route::get('/kategori/{category}', [ProductController::class, 'showCategory'])->name('category');

// cart and checkout
Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add'); 
Route::get('/cart', [CartController::class, 'showCart'])->name('cart'); 
Route::put('/cart/update/{productId}', [CartController::class, 'updateCart'])->name('cart.update'); // Update keranjang
Route::delete('/cart/remove/{productId}', [CartController::class, 'removeFromCart'])->name('cart.remove'); // Hapus produk dari keranjang
Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear'); // Hapus semua produk
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');

//Admin route//
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/inbox', [InboxController::class, 'index'])->name('inbox');
Route::post('/inbox/send-message', [InboxController::class, 'sendMessage'])->name('inbox.send-message');
//manageproduct
Route::get('manage_product', [SellerController::class, 'index'])->name('manage_product.index');
Route::post('manage_product', [SellerController::class, 'store'])->name('manage_product.store');
Route::put('/admin/manage_product/{id}', [SellerController::class, 'update'])->name('manage_product.update');
Route::delete('/admin/manage_product/{id}', [SellerController::class, 'destroy'])->name('manage_product.destroy');
//team
Route::prefix('team')->group(function () {
    Route::get('/', [TimController::class, 'index'])->name('team.index');
    Route::get('/create', [TimController::class, 'create'])->name('team.create');
    Route::post('/store', [TimController::class, 'store'])->name('team.store');
});