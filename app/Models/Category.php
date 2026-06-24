<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'image', 'is_active',
    ];

    protected $appends = ['image_url'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // ── Relationships ─────────────────────────────────────
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // ── Accessors ─────────────────────────────────────────
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) return null;

        return Str::startsWith($this->image, 'http')
            ? $this->image
            : asset('storage/' . $this->image);
    }
}
