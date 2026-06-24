<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    // ── Relationships ──────────────────────────────────────

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // ── Accessors ──────────────────────────────────────────

    /**
     * Returns the user's avatar URL.
     * Falls back to a generated initials avatar if none is set.
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) return $this->avatar;

        $initials = urlencode(
            collect(explode(' ', $this->name))
                ->map(fn($w) => strtoupper(substr($w, 0, 1)))
                ->take(2)
                ->join('')
        );

        return "https://ui-avatars.com/api/?name={$initials}&background=2563eb&color=fff&size=128";
    }
}