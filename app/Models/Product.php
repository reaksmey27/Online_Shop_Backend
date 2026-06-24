<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description',
        'price', 'stock', 'image', 'is_active',
    ];

    protected $appends = ['image_url'];

    protected $casts = [
        'price'     => 'decimal:2',
        'is_active' => 'boolean',
        'stock'     => 'integer',
    ];

    // ── Relationships ──────────────────────────────────────

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // ── Accessors ──────────────────────────────────────────

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) return null;

        return Str::startsWith($this->image, 'http')
            ? $this->image
            : asset('storage/' . $this->image);
    }

    /**
     * Bug #4 fix: use already-loaded reviews relationship to avoid
     * firing an extra DB query each time average_rating is accessed.
     * If reviews are eager-loaded, this uses the cached collection.
     * Only falls back to a DB query if reviews are NOT loaded.
     */
    public function getAverageRatingAttribute(): float
    {
        if ($this->relationLoaded('reviews')) {
            $avg = $this->reviews->avg('rating');
        } else {
            $avg = $this->reviews()->avg('rating');
        }

        return round($avg ?? 0, 1);
    }
}
