<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserOrderController;

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



Route::get('/', function () {
    return redirect('login');
});

Route::middleware(['auth', 'administrator'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::resource('product', UserProductController::class);
    Route::resource('cart', CartController::class);
    Route::resource('order', UserOrderController::class);
    Route::get('/home', [App\Http\Controllers\HomeUserController::class, 'index'])->name('home');
    Route::get('cart/remove', [App\Http\Controllers\CartController::class, 'remove']);
});


Route::get('/login', [LoginController::class, 'index']);

Auth::routes();

