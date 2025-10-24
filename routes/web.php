<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/modules', [PageController::class, 'modules'])->name('modules');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/module/{id}', [PageController::class, 'moduleDetail'])->name('module.detail');
Route::get('/cart', [PageController::class, 'cart'])->name('cart');
Route::post('/cart/add', [PageController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove/{index}', [PageController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');
Route::post('/checkout/process', [PageController::class, 'processCheckout'])->name('checkout.process');