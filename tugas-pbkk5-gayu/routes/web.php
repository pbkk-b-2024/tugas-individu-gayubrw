<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Gate;

// Route for main login page
Route::get('/', function () {
    return view('auth.login');
})->name('home');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Product management routes accessible only to admin
Route::middleware(['auth', 'can:admin-access'])->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    
    // Orders routes - hanya admin yang bisa mengakses
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/confirmation/{order}', [OrderController::class, 'confirmation'])->name('orders.confirmation');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

// General product routes accessible to all authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    
    // Review routes for general users
    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    
    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
    Route::resource('categories', CategoryController::class);
    
    Route::resource('wishlist', WishlistController::class);
    Route::post('/wishlist/add/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
    
    // Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
    Route::patch('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    
    // Checkout routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'processOrder'])->name('checkout.process');

    // Daftar pesanan, admin melihat semua, guest melihat pesanan sendiri
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    Route::get('/orders/confirmation/{order}', [OrderController::class, 'confirmation'])->name('orders.confirmation');
    
    // Detail pesanan, admin bisa melihat semua pesanan, guest hanya melihat pesanan mereka sendiri
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    
    // Contact route
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
});

// Include additional auth routes
require __DIR__.'/auth.php';
