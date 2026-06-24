<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;

// ─── Admin Pages ───────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware('web')->group(function () {

    Route::get('/login', fn() => view('admin.auth.login'))->name('login');
    Route::post('/login', [DashboardController::class, 'login'])->name('login.post');

    // Logout
    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('orders', OrderController::class);
        Route::resource('users', UserController::class);
    });
});