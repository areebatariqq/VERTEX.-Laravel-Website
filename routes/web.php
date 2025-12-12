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

// Checkout Routes - Protected by auth middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/process', [PageController::class, 'processCheckout'])->name('checkout.process');
});

// Auth Routes
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'authenticate'])->name('login.process');
Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register.process');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Admin Routes - Protected by auth middleware and admin check
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        $modulesCount = \App\Models\Module::count();
        $usersCount = \App\Models\User::where('role', 'user')->count();
        
        // Check if orders table exists before querying
        try {
            $ordersCount = \App\Models\Order::count();
        } catch (\Exception $e) {
            $ordersCount = 0;
        }
        
        $recentModules = \App\Models\Module::latest()->take(5)->get();
        return view('admin.dashboard', compact('modulesCount', 'usersCount', 'ordersCount', 'recentModules'));
    })->name('dashboard');

    // Module Management
    Route::resource('modules', App\Http\Controllers\Admin\ModuleController::class);

    // Order Management
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'adminIndex'])->name('orders.index');
    Route::get('/orders/{id}', [App\Http\Controllers\OrderController::class, 'adminShow'])->name('orders.show');
    Route::put('/orders/{id}', [App\Http\Controllers\OrderController::class, 'adminUpdate'])->name('orders.update');
    Route::delete('/orders/{id}', [App\Http\Controllers\OrderController::class, 'adminDestroy'])->name('orders.destroy');
});