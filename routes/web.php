<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StocksController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\ReturnsController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
    // Route::resource('/posts', \App\Http\Controllers\PostController::class);
    Route::resource('posts', \App\Http\Controllers\PostController::class);
    Route::get('/stocks/available', [DashboardController::class, 'showAvailableStocks'])->name('stocks.available');
    Route::get('/stocks/extra', [DashboardController::class, 'showExtraStocks'])->name('stocks.extra');
    Route::get('/stocks/return', [DashboardController::class, 'showReturnStocks'])->name('stocks.return');
    Route::get('/stocks/supply', [DashboardController::class, 'showSupplyyStocks'])->name('stocks.supply');

    Route::resource('stocks', \App\Http\Controllers\StocksController::class);
    Route::resource('suppliers', \App\Http\Controllers\SuppliersController::class);
    Route::get('/stocks/available', [StocksController::class, 'index'])->name('stocks.available');
    Route::get('/stocks/supply', [SuppliersController::class, 'index'])->name('stocks.supply');
    // Route::put('supply/{supplier}', [SuppliersController::class, 'update'])->name('supply.update');
    Route::delete('/supply/{supplier}', [\App\Http\Controllers\SuppliersController::class, 'destroy'])->name('supply.destroy');

    Route::resource('returns', \App\Http\Controllers\ReturnsController::class);
    Route::get('/stocks/return', [ReturnsController::class, 'index'])->name('stocks.return');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});
