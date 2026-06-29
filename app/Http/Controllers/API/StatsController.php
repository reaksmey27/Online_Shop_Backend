<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\User;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class StatsController extends Controller
{
    public function index(): JsonResponse
    {
        $totalUsers    = User::count();
        $totalProducts = Product::count();
        $avgRating     = Review::avg('rating');

        return response()->json([
            'athletes' => $totalUsers,
            'products' => $totalProducts,
            'rating'   => $avgRating ? round($avgRating, 1) : 0,
        ]);
    }
}
