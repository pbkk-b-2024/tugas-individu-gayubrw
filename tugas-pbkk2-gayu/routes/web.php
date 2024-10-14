<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/dashboard/edit', function () {
    // Tambahkan logika untuk mengedit dashboard jika diperlukan
    return view('dashboard-edit');
})->name('dashboard.edit');

Route::patch('/dashboard/update', function () {
    // Tambahkan logika untuk update dashboard jika diperlukan
    return redirect()->route('dashboard');
})->name('dashboard.update');

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::prefix('products')->name('products.')->group(function () {
    // Daftar Produk
    Route::get('/', [ProductController::class, 'index'])->name('index');

    // Tambah Produk (Form)
    Route::get('/create', [ProductController::class, 'create'])->name('create');

    // Simpan Produk Baru
    Route::post('/', [ProductController::class, 'store'])->name('store');

    // Edit Produk (Form)
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');

    // Update Produk
    Route::put('/{product}', [ProductController::class, 'update'])->name('update');

    // Hapus Produk
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
});

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');