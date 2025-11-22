<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\RentalController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReviewController;

/**
 * -------------------------
 *  PUBLIC ROUTES (guest)
 * -------------------------
 */

// Landing page (halaman depan seperti mockup)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Katalog & detail produk (publik bisa lihat)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{item_id}', [ProductController::class, 'show'])->name('products.show');

// Product reviews endpoints (used by product detail AJAX)
Route::get('/products/{productKey}/reviews', [ProductReviewController::class, 'index'])->name('products.reviews.index');
Route::post('/products/{productKey}/reviews', [ProductReviewController::class, 'store'])->middleware('auth')->name('products.reviews.store');

// Keranjang (boleh guest; simpan di session)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');                 // tambah item
Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cart.update');    // ubah qty
Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy'); // hapus item

// OAuth (placeholder)
Route::get('/auth/redirect/{provider}', fn () => abort(501))->name('social.redirect');


/**
 * -------------------------
 *  AUTHENTICATED ROUTES
 * -------------------------
 */

// Checkout (WAJIB login). Jika belum login, Laravel redirect ke /login dan balik lagi ke /checkout setelah sukses.
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // /admin
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Produk / Items
        Route::resource('items', ItemController::class)->except(['show']);

        // Rental
        Route::resource('rentals', RentalController::class)->only(['index', 'show', 'update']);

        // User (ubah role)
        Route::resource('users', UserController::class)->only(['index', 'show']);

        // Review
        Route::resource('reviews', ReviewController::class)->only(['index', 'update', 'destroy']);
    });



require __DIR__.'/auth.php';


