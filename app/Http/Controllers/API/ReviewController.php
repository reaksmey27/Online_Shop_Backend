<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * List reviews for a product with average rating and breakdown.
     */
    public function index(Request $request, $productId)
    {
        $sort = match ($request->sort) {
            'highest' => ['rating', 'desc'],
            'lowest'  => ['rating', 'asc'],
            default   => ['created_at', 'desc'],
        };

        $reviews = Review::with('user:id,name')
            ->where('product_id', $productId)
            ->orderBy(...$sort)
            ->get();

        $breakdown = [];
        for ($i = 1; $i <= 5; $i++) {
            $breakdown[$i] = $reviews->where('rating', $i)->count();
        }

        return response()->json([
            'reviews'        => $reviews,
            'average_rating' => round($reviews->avg('rating') ?? 0, 1),
            'total'          => $reviews->count(),
            'breakdown'      => $breakdown,
        ]);
    }

    /**
     * Store a review — only if user has a delivered/completed order containing this product.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating'     => 'required|integer|min:1|max:5',
            'title'      => 'nullable|string|max:120',
            'comment'    => 'nullable|string|max:2000',
        ]);

        $userId    = $request->user()->id;
        $productId = $request->product_id;

        // Verify purchase: any non-cancelled order containing this product
        $hasPurchased = Order::where('user_id', $userId)
            ->whereIn('status', ['pending', 'processing', 'shipped', 'delivered', 'completed'])
            ->whereHas('items', fn ($q) => $q->where('product_id', $productId))
            ->exists();

        if (! $hasPurchased) {
            return response()->json([
                'message' => 'You can only review products you have purchased.',
            ], 403);
        }

        $alreadyReviewed = Review::where('user_id', $userId)
            ->where('product_id', $productId)
            ->exists();

        if ($alreadyReviewed) {
            return response()->json(['message' => 'You have already reviewed this product.'], 422);
        }

        $review = Review::create([
            'user_id'    => $userId,
            'product_id' => $productId,
            'rating'     => $request->rating,
            'title'      => $request->title,
            'comment'    => $request->comment,
        ]);

        return response()->json([
            'message' => 'Review submitted successfully.',
            'review'  => $review->load('user:id,name'),
        ], 201);
    }

    /**
     * Update own review (rating, title, comment).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rating'  => 'sometimes|integer|min:1|max:5',
            'title'   => 'nullable|string|max:120',
            'comment' => 'nullable|string|max:2000',
        ]);

        $review = Review::where('user_id', $request->user()->id)
            ->where('id', $id)
            ->firstOrFail();

        $review->update($request->only('rating', 'title', 'comment'));

        return response()->json([
            'message' => 'Review updated.',
            'review'  => $review->load('user:id,name'),
        ]);
    }

    /**
     * Delete own review.
     */
    public function destroy(Request $request, $id)
    {
        Review::where('user_id', $request->user()->id)
            ->where('id', $id)
            ->firstOrFail()
            ->delete();

        return response()->json(['message' => 'Review deleted.']);
    }
}
