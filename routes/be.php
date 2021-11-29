<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VariantController;
use App\Http\Controllers\Admin\VariantValueController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OderProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('', [AuthController::class, 'checkLevel'])->name('admin.home');
    Route::prefix('/user')->group(function () {
        Route::get('', [UserController::class, 'list'])->name('admin.user.list');
        Route::get('/add', [UserController::class, 'add'])->name('admin.user.add');
        Route::post('/doadd', [UserController::class, 'doAdd'])->name('admin.user.doAdd');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::post('/doedit/{id}', [UserController::class, 'doEdit'])->name('admin.user.doedit');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('admin.user.delete');
        Route::get('/search', [UserController::class, 'search'])->name('admin.user.search');
    });
    Route::prefix('/category')->group(function () {
        Route::get('', [CategoryController::class, 'list'])->name('admin.category.list');
        Route::get('/add', [CategoryController::class, 'add'])->name('admin.category.add');
        Route::post('/doadd', [CategoryController::class, 'doAdd'])->name('admin.category.doAdd');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::post('/doedit/{id}', [CategoryController::class, 'doEdit'])->name('admin.category.doedit');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');
    });
    Route::prefix('/variant')->group(function () {
        Route::get('', [VariantController::class, 'list'])->name('admin.variant.list');
        Route::get('/add', [VariantController::class, 'add'])->name('admin.variant.add');
        Route::post('/doadd', [VariantController::class, 'doAdd'])->name('admin.variant.doAdd');
        Route::get('/edit/{id}', [VariantController::class, 'edit'])->name('admin.variant.edit');
        Route::post('/doedit/{id}', [VariantController::class, 'doEdit'])->name('admin.variant.doedit');
        Route::get('/delete/{id}', [VariantController::class, 'delete'])->name('admin.variant.delete');
    });
    Route::prefix('/variant_value')->group(function () {
        Route::get('', [VariantValueController::class, 'list'])->name('admin.variant_value.list');
        Route::get('/add', [VariantValueController::class, 'add'])->name('admin.variant_value.add');
        Route::post('/doadd', [VariantValueController::class, 'doAdd'])->name('admin.variant_value.doAdd');
        Route::get('/edit/{id}', [VariantValueController::class, 'edit'])->name('admin.variant_value.edit');
        Route::post('/doedit/{id}', [VariantValueController::class, 'doEdit'])->name('admin.variant_value.doedit');
        Route::get('/delete/{id}', [VariantValueController::class, 'delete'])->name('admin.variant_value.delete');
    });
    Route::prefix('/product')->group(function () {
        Route::get('', [ProductController::class, 'list'])->name('admin.product.list');
        Route::get('/search', [ProductController::class, 'search'])->name('admin.product.search');
        Route::get('/add', [ProductController::class, 'add'])->name('admin.product.add');
        Route::post('/doadd', [ProductController::class, 'doAdd'])->name('admin.product.doAdd');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::get('/detail/{id}', [ProductController::class, 'edit'])->name('admin.product.detail');
        Route::post('/doedit/{id}', [ProductController::class, 'doEdit'])->name('admin.product.doEdit');
        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('admin.product.delete');
    });
    Route::prefix('/oder')->group(function () {
        Route::get('', [OderController::class, 'list'])->name('admin.oder.list');
        Route::get('/add', [OderController::class, 'add'])->name('admin.oder.add');
        Route::post('/doadd', [OderController::class, 'doAdd'])->name('admin.oder.doAdd');
        Route::get('/edit/{id}', [OderController::class, 'edit'])->name('admin.oder.edit');
        Route::post('/doedit/{id}', [OderController::class, 'doEdit'])->name('admin.oder.doedit');
        Route::get('/detail/{id}', [OderController::class, 'detail'])->name('admin.oder.detail');
        Route::get('/oder/deleteitem/{id}', [OderController::class, 'deleteItem'])->name('admin.oder.deleteitem');
        Route::get('/oder/update/{id}', [OderController::class, 'update'])->name('admin.oder.update');
    });
});