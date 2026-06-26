<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'category',
        'price',
        'stock',
        'image_path',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('is_active', true)->where('stock', '>', 0);
    }

    public function formattedPrice(): string
    {
        return '$' . number_format((float) $this->price, 2, '.', ',');
    }

    /**
     * Get the purchases that contain this product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchases(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    /**
     * Get the users who purchased this product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'purchases')
            ->withPivot('price_paid')
            ->withTimestamps();
    }
}