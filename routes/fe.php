<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', [FeController::class, 'home'])->name('fe.home');
Route::get('/product/detail/{id}', [ProductController::class, 'detail'])->name('fe.product.detail');
Route::get('/category/{id}', [ProductController::class, 'category'])->name('fe.category');
Route::get('/search', [FeController::class, 'search'])->name('fe.search');
Route::get('/cart', [CartController::class, 'index'])->name('fe.cart');
Route::get('/user/{id}', [FeController::class, 'user'])->name('fe.user');
Route::post('/user/checkout', [FeController::class, 'checkout'])->name('fe.checkout');