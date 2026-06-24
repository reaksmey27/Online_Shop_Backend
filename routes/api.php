<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\GoogleAuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\WishlistController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\ProfileController;

// ── PUBLIC ROUTES ─────────────────────────────────────────

// Standard Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Google OAuth
Route::get('/auth/google/url',      [GoogleAuthController::class, 'redirectUrl']);
Route::get('/auth/google/callback',  [GoogleAuthController::class, 'callback']);

// Products & Categories (public browsing)
Route::get('/categories',      [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);

Route::get('/products',        [ProductController::class, 'index']);
Route::get('/products/search', [ProductController::class, 'search']);
Route::get('/products/{id}',   [ProductController::class, 'show']);

Route::get('/products/{productId}/reviews', [ReviewController::class, 'index']);

// ── PRIVATE ROUTES (Sanctum token required) ───────────────

Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me',      [AuthController::class, 'me']);

    // Profile
    Route::put('/profile',          [ProfileController::class, 'update']);
    Route::put('/profile/password', [ProfileController::class, 'changePassword']);

    // Cart
    Route::get('/cart',         [CartController::class, 'index']);
    Route::post('/cart',        [CartController::class, 'add']);
    Route::put('/cart/{id}',    [CartController::class, 'update']);
    Route::delete('/cart/{id}', [CartController::class, 'remove']);
    Route::delete('/cart',      [CartController::class, 'clear']);

    // Wishlist
    Route::get('/wishlist',         [WishlistController::class, 'index']);
    Route::post('/wishlist',        [WishlistController::class, 'add']);
    Route::delete('/wishlist/{id}', [WishlistController::class, 'remove']);

    // Orders (checkout must be before {id})
    Route::post('/orders/checkout', [OrderController::class, 'checkout']);
    Route::get('/orders',           [OrderController::class, 'index']);
    Route::get('/orders/{id}',      [OrderController::class, 'show']);

    // Reviews
    Route::post('/reviews',        [ReviewController::class, 'store']);
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);
});