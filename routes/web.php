<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// Middleware
use App\Http\Middleware\CheckIfAdmin;
// Public Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AddressController; // <-- New
// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CouponController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// == 1. PUBLIC ROUTES ==
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.products');
Route::get('/about-us', function() { return view('pages.about'); })->name('about');
Route::get('/faq', function() { return view('pages.faq'); })->name('pages.faq');

// == 2. CART & PAYMENT ROUTES ==
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.apply-coupon');
Route::get('/payment/callback', [CheckoutController::class, 'callback'])->name('payment.callback');

// == 3. AUTHENTICATED USER ROUTES ==
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile.orders');
    
    // Address Management for User
    Route::resource('addresses', AddressController::class); // <-- NEW: This adds all routes for addresses
    
    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
});

// == 4. ADMIN PANEL ROUTES ==
Route::middleware(['auth', CheckIfAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', AdminProductController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('coupons', CouponController::class);
    Route::get('reports/popular-categories', [ReportController::class, 'popularCategories'])->name('reports.popular-categories');
});

// Includes all authentication routes
require __DIR__.'/auth.php';
