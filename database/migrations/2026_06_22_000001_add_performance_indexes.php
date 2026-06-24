<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Add missing performance indexes for frequently queried columns.
 * These cover the most common WHERE clauses and JOIN conditions.
 */
return new class extends Migration
{
    public function up(): void
    {
        // Products: is_active + category filter + price sort are the hot paths
        Schema::table('products', function (Blueprint $table) {
            $table->index(['is_active', 'created_at'], 'products_active_created');
            $table->index(['is_active', 'category_id'], 'products_active_category');
            $table->index(['is_active', 'price'], 'products_active_price');
            $table->index(['is_active', 'name'], 'products_active_name');
        });

        // Categories: is_active filter
        Schema::table('categories', function (Blueprint $table) {
            $table->index('is_active', 'categories_active');
        });

        // Cart: always queried by user_id
        Schema::table('cart_items', function (Blueprint $table) {
            $table->index('user_id', 'cart_user');
        });

        // Wishlist: always queried by user_id
        Schema::table('wishlists', function (Blueprint $table) {
            $table->index('user_id', 'wishlist_user');
        });

        // Orders: always queried by user_id + sorted by created_at
        Schema::table('orders', function (Blueprint $table) {
            $table->index(['user_id', 'created_at'], 'orders_user_created');
        });

        // Reviews: always queried by product_id
        Schema::table('reviews', function (Blueprint $table) {
            $table->index('product_id', 'reviews_product');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('products_active_created');
            $table->dropIndex('products_active_category');
            $table->dropIndex('products_active_price');
            $table->dropIndex('products_active_name');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex('categories_active');
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropIndex('cart_user');
        });

        Schema::table('wishlists', function (Blueprint $table) {
            $table->dropIndex('wishlist_user');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex('orders_user_created');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropIndex('reviews_product');
        });
    }
};
