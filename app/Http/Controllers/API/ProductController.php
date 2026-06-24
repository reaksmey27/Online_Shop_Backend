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
            ->where('is_active', true);

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
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

        // Use the model accessor instead of firing a raw query
        $product->append('average_rating');

        return response()->json($product);
    }

    public function search(Request $request)
    {
        $request->validate(['q' => 'required|string|min:1|max:100']);

        $q = $request->q;

        $products = Product::with('category')
            ->where('is_active', true)
            ->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('description', 'like', "%{$q}%");
            })
            ->limit(20)
            ->get();

        return response()->json($products);
    }
}
