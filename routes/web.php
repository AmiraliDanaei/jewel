<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


use App\Http\Middleware\CheckIfAdmin;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\WishlistController; 


use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;




Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.products');
Route::get('/about-us', function() { return view('pages.about'); })->name('about');
Route::get('/faq', function() { return view('pages.faq'); })->name('pages.faq');


Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.apply-coupon');


Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile.orders');
    
    
    Route::resource('addresses', AddressController::class)->except(['show', 'destroy', 'update', 'edit']);
    

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index')->middleware('verified');
    Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder')->middleware('verified');
    
    
    Route::get('/payment/{order}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/{order}/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/{order}/fail', [PaymentController::class, 'fail'])->name('payment.fail');
    Route::get('/thank-you', [PaymentController::class, 'thankyou'])->name('payment.thankyou');
     
    Route::post('/products/{product}/comments', [CommentController::class, 'store'])->name('comments.store');

    
    Route::get('/profile/wishlist', [WishlistController::class, 'index'])->name('profile.wishlist');
    Route::post('/wishlist/toggle/{product}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
});


Route::middleware(['auth', CheckIfAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', AdminProductController::class);
    Route::resource('orders', AdminOrderController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('coupons', CouponController::class);
    Route::get('reports/popular-categories', [ReportController::class, 'popularCategories'])->name('reports.popular-categories');
    
    Route::post('/comments/{comment}/reply', [AdminCommentController::class, 'storeReply'])->name('comments.reply');
    Route::resource('comments', AdminCommentController::class)->except(['create', 'show', 'store']);
});


require __DIR__.'/auth.php';
