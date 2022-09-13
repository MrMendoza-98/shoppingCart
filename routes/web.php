<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
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

Route::get('/', [ProductController::class, 'productList'])->name('products.list');
Route::get('cart', [ProductController::class, 'cartList'])->name('cart.list');
Route::post('cart', [ProductController::class, 'addToCart'])->name('cart.store');
Route::get('checkout', [CheckoutController::class, 'getCheckout'])->name('checkout.index');
Route::post('checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.place.order');
Route::get('complete/{id}', [CheckoutController::class, 'response'])->name('success');

