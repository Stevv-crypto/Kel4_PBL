<?php

use Illuminate\Support\Facades\Route;

/*
/-----------------------------------------------------------
/ NAMESPACE PEMBELI
/-----------------------------------------------------------
*/

use App\Livewire\Chat\Index;
use App\Livewire\Chat\Chat;
use App\Livewire\ChatUsers;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DetailproductController;
use App\Http\Controllers\viewAllController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderListController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\PasswordResetLinkController;
use App\Http\Controllers\VerificationController;

/*
/---------------------------------------------------------------
/ NAMESPACE PENJUAL
/---------------------------------------------------------------
*/

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductAdminController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\TimController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MerkController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\SalesReportController;

Route::get('/', [SalesReportController::class, 'bestSeller'])->name('landing');

/*
/------------------------------------------------------------------
/ AUTHENTICATION ROUTE
/------------------------------------------------------------------
/ Semua route terkait register, login, dan logout
*/

// =========================== Route untuk register ======================================
Route::get('/register', [AuthController::class, 'tampilRegister'])->name('tampilRegister');
Route::post('/register', [AuthController::class, 'dataRegister'])->name('dataRegister');

// ========================= Route untuk login ================================
Route::get('/login', [AuthController::class, 'tampilLogin'])->name('login');
Route::post('/login', [AuthController::class, 'dataLogin'])->name('dataLogin');

// ==================== Route untuk logout =============================
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/*
/-----------------------------------------------------------------------------------
/ ROUTE UNTUK VERIFIKASI EMAIL
/-----------------------------------------------------------------------------------
/ Route yang berfungsi untuk verifikasi email dahulu ketika mau masuk ke home page setelah
/ registrasi dan ketika mau mengakses forgot password
*/

// ==================== Forgot password dengan verifikasi email ======================================
Route::prefix('reset')->group(function() {
    Route::post('/verify', [VerificationController::class, 'store'])->name('reset.send_otp');
    Route::get('/verify/{unique_id}', [VerificationController::class, 'show'])->name('reset.show_otp');
    Route::put('/verify/{unique_id}', [VerificationController::class, 'update'])->name('reset.update');
});

// ====================== Register dengan verifikasi email ============================================
Route::group(['middleware' => ['auth', 'check_role:pembeli']], function() {
    Route::get('/verify', [VerificationController::class, 'index'])->name('verify');
    Route::post('/verify', [VerificationController::class, 'store'])->name('verify.send_otp');
    Route::get('/verify/{unique_id}', [VerificationController::class, 'show'])->name('verify.show_otp');
    Route::put('/verify/{unique_id}', [VerificationController::class, 'update'])->name('verify.update');
});

/*
/------------------------------------------------------------------------------------------------------
/ ROUTE YANG DAPAT DIAKSES TANPA PERLU LOGIN
/-------------------------------------------------------------------------------------------------------
*/

// ================================== Forgot Password ===================================================
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');

// ============================= Reset Password ================================================
Route::get('/reset-password', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');

// =============================== Home Page ========================================
Route::get('/home_page', [ProductController::class, 'tampilHome'])->name('home_page');

// ================================== Detail Produk ============================================
Route::get('/product/{code_product}', [ProductController::class, 'show'])->name('product.show');

// ============================ About =================================
Route::get('/about', [AboutController::class, 'about'])->name('about');

// ================================= Kategori ===========================================
Route::get('/category/{code}', [CategoryController::class, 'show'])->name('category.show');

// ========================== Search Engine ================================
Route::get('/search', [productController::class, 'search'])->name('search');

/*
/----------------------------------------------------------------------------------
/ ROUTE YANG DAPAT DIAKSES KETIKA PENGGUNA SUDAH LOGIN
/--------------------------------------------------------------------------------
*/
// =========== Aut ====
Route::group(['middleware' => ['auth']], function() {
    // Chat
    Route::get('/chat', Index::class)->name('chat.index');
    Route::get('/chat-users', ChatUsers::class)->name('chat-users');
    Route::get('/chat/{query}', Chat::class)->name('chat');
});

// Pengelompokan route dengan middleware
Route::group(['middleware' => ['auth', 'check_role:pembeli', 'check_status']], function() {
    Route::get('/detail_product', [DetailproductController::class, 'detail'])->name('detail_product');
    Route::get('/productAdmin', [ProductAdminController::class, 'tampilProduk'])->name('produkAdmin');
    Route::get('/category', [ProductController::class, 'tampilKategori'])->name('category');
    Route::get('/category', [ProductController::class, 'tampilKategori'])->name('tampilKategori');

    // Change Password
    Route::get('/change-password', [PasswordController::class, 'edit'])->name('change.password');
    Route::post('/change-password', [PasswordController::class, 'update'])->name('change.password.update');

    Route::get('/product', [productController::class, 'tampilProduk'])->name('products');
    Route::get('/products', [ViewAllController::class, 'tampilProduk'])->name('products');
    Route::get('/kategori/{category}', [ProductController::class, 'showCategory'])->name('category');

    // Cart
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart'); 
    Route::put('/cart/update/{code_product}', [CartController::class, 'updateCart'])->name('cart.update'); // Update keranjang
    Route::post('/cart/add/{code_product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{code_product}', [CartController::class, 'removeFromCart'])->name('cart.remove'); // Hapus produk dari keranjang

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout.show');
    Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

    //category
    Route::resource('category', CategoryController::class);
    Route::get('/category/{code}/product', [CategoryController::class, 'showProduct'])->name('category.product');
    Route::patch('/category/{code}/status', [CategoryController::class, 'updateStatus'])->name('category.updateStatus');
    Route::delete('/category/{code}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/category/{code}', [CategoryController::class, 'show'])->name('category.show');

    // Order list
    Route::get('/orderList', [OrderListController::class, 'index'])->name('order.list');
    Route::get('/order/invoice/{order_code}', [OrderListController::class, 'invoice'])->name('order.invoice');
});

// Admin route
Route::group(['middleware' => ['auth', 'check_role:admin', 'check_status']], function() {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/inbox', [InboxController::class, 'index'])->name('inbox');
    Route::post('/inbox/send-message', [InboxController::class, 'sendMessage'])->name('inbox.send-message');
    
    Route::get('/order', [OrderController::class, 'order'])->name('order');
    

    //manageproduct
    Route::get('manage_product', [SellerController::class, 'index'])->name('manage_product.index');
    Route::post('manage_product', [SellerController::class, 'store'])->name('manage_product.store');
    Route::put('/admin/manage_product/{code_product}', [SellerController::class, 'update'])->name('manage_product.update');
    Route::delete('/manage_product/{code_product}', [SellerController::class, 'destroy'])->name('manage_product.destroy');
    Route::put('/admin/stock/{code_product}', [SellerController::class, 'updateStock'])->name('stock.update');
    // Brand routes
    Route::post('/admin/brand', [SellerController::class, 'storeMerk'])->name('brand.store');
    Route::put('/admin/brand/{code}', [SellerController::class, 'updateMerk'])->name('brand.update');
    Route::delete('/admin/brand/{code}', [SellerController::class, 'destroyMerk'])->name('brand.destroy');
    // Category CRUD
    Route::post('/admin/category', [SellerController::class, 'storeCategory'])->name('category.store');
    Route::put('/admin/category/{code}', [SellerController::class, 'updateCategory'])->name('category.update');
    Route::delete('/admin/category/{code}', [SellerController::class, 'destroyCategory'])->name('category.destroy');




    //setting
    Route::get('/admin/settings', [SiteSettingController::class, 'edit'])->name('settings.edit');
    Route::post('/admin/settings', [SiteSettingController::class, 'update'])->name('settings.update');

    //team
    Route::prefix('team')->group(function () {
        Route::get('/', [TimController::class, 'index'])->name('team.index');
        Route::get('/create', [TimController::class, 'create'])->name('team.create');
        Route::post('/store', [TimController::class, 'store'])->name('team.store');

    //merk
    Route::get('admin/merk', [MerkController::class, 'index'])->name('merk.index');
    Route::post('admin/merk', [MerkController::class, 'store'])->name('merk.store');
    Route::put('admin/merk/{merk}', [MerkController::class, 'update'])->name('merk.update');
    Route::delete('admin/merk/{merk}', [MerkController::class, 'destroy'])->name('merk.destroy');
    Route::patch('admin/merk/{merk}/status', [MerkController::class, 'updateStatus'])->name('merk.updateStatus');
    });

    //order
    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::post('/order/{order}/confirm', [OrderController::class, 'confirm'])->name('order.confirm');
    Route::post('/order/{order}/reject', [OrderController::class, 'reject'])->name('order.reject');
    Route::post('/order/{order}/update-status', [OrderController::class, 'updateStatus'])->name('order.updateStatus');

    //Invoice
    Route::post('/invoice', [InvoiceController::class, 'invoice'])->name('invoice');
    Route::get('/invoice', [InvoiceController::class, 'showInvoice'])->name('invoice.show');

    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');

    Route::get('/admin/sales-report', [SalesReportController::class, 'index'])->name('sales.report');
});