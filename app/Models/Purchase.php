<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Purchase
 *
 * Models the purchase relation between users and products.
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property float $price_paid
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
class Purchase extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'price_paid',
    ];

    protected function casts(): array
    {
        return [
            'price_paid' => 'decimal:2',
        ];
    }

    /**
     * Get the user who made the purchase.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product that was purchased.
     *
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
