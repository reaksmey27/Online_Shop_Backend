<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Whitelist allowed sort columns to prevent SQL injection
    private const SORTABLE_COLUMNS = ['created_at', 'price', 'name', 'stock'];

    public function index(Request $request)
    {
        $query = Product::with('category')
            ->withAvg('reviews', 'rating')
            ->where('is_active', true);

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Price range filter
        if ($request->filled('price_min')) {
            $query->where('price', '>=', (float) $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', (float) $request->price_max);
        }

        // In-stock filter
        if ($request->boolean('in_stock')) {
            $query->where('stock', '>', 0);
        }

        // Search by name or description
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Whitelist sort column (Bug #2 fix — prevent SQL injection)
        $sort  = in_array($request->sort, self::SORTABLE_COLUMNS)
                    ? $request->sort
                    : 'created_at';
        $order = $request->order === 'asc' ? 'asc' : 'desc';

        $query->orderBy($sort, $order);

        $perPage  = min((int) ($request->per_page ?? 12), 50); // cap at 50
        $products = $query->paginate($perPage);

        return response()->json($products);
    }

    public function show($id)
    {
        $product = Product::with(['category', 'reviews.user'])
            ->where('is_active', true)
            ->findOrFail($id);

        // average_rating accessor uses the already-loaded reviews relation
        // (no extra DB query needed — append triggers the model accessor)
        $product->append('average_rating');

        return response()->json($product);
    }

    public function search(Request $request)
    {
        $request->validate(['q' => 'required|string|min:1|max:100']);

        $q = $request->q;

        $products = Product::with('category')
            ->withAvg('reviews', 'rating')
            ->where('is_active', true)
            ->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('description', 'like', "%{$q}%");
            })
            ->limit(20)
            ->get();

        return response()->json($products);
    }

    public function related(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $related = Product::with('category')
            ->withAvg('reviews', 'rating')
            ->where('is_active', true)
            ->where('id', '!=', $id)
            ->where('category_id', $product->category_id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return response()->json($related);
    }
}
