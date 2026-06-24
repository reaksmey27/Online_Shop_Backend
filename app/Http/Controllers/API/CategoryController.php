<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->get();

        return response()->json($categories);
    }

    public function show($id)
    {
        $category = Category::where('is_active', true)
            ->withCount('products')
            ->findOrFail($id);

        return response()->json($category);
    }
}