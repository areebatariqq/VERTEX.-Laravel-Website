<?php

use App\Http\Controllers\Api\ModuleApiController;
use App\Http\Controllers\Api\OrderApiController;
use Illuminate\Support\Facades\Route;

// Module API Routes
Route::name('module.')->prefix('module')->group(function() {
    Route::get('/', [ModuleApiController::class, 'index'])->name('index');
    Route::get('create', [ModuleApiController::class, 'create'])->name('create');
    Route::post('store', [ModuleApiController::class, 'store'])->name('store');
    Route::get('edit/{id}', [ModuleApiController::class, 'edit'])->name('edit');
    Route::post('update', [ModuleApiController::class, 'update'])->name('update');
    Route::get('destroy/{id}', [ModuleApiController::class, 'destroy'])->name('destroy');
});

// Order API Routes
Route::name('order.')->prefix('order')->group(function() {
    Route::get('/', [OrderApiController::class, 'index'])->name('index');
    Route::get('show/{id}', [OrderApiController::class, 'show'])->name('show');
    Route::post('store', [OrderApiController::class, 'store'])->name('store');
    Route::post('update', [OrderApiController::class, 'update'])->name('update');
    Route::get('destroy/{id}', [OrderApiController::class, 'destroy'])->name('destroy');
});
