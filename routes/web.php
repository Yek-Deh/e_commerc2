<?php

use App\Http\Controllers\AddToCartController;
use App\Http\Controllers\CartPageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [ProductController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('product', ProductController::class);

Route::get('/',[ProductPageController::class,'index'])->name('home');
Route::get('/product-details/{id}',[ProductPageController::class,'detail'])->name('product.details');

//cart routes
Route::post('/add-to-cart/{id}',[AddToCartController::class,'addToCart'])->name('add-to-cart');
Route::get('/cart',[CartPageController::class,'index'])->name('cart.index');
Route::delete('/remove-from-cart/{id}',[AddToCartController::class,'destroy'])->name('remove-from-cart');
Route::post('/update-quantity',[AddToCartController::class,'updateQuantity'])->name('update-quantity');

