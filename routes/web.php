<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/dologin', [AuthController::class, 'dologin'])->name('auth.dologin');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/user/check', [AuthController::class, 'checkout'])->name('auth.checkout');
require_once __DIR__ . '/be.php'; //magic constant
require_once __DIR__ . '/fe.php';