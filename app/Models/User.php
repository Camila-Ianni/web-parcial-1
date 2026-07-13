<?php

namespace App\Models;


use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    
    use HasFactory, Notifiable;

    
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'profile_image',
    ];

    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    
    public function purchases(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    /**
     * Get the products purchased by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'purchases')
            ->withPivot('price_paid')
            ->withTimestamps();
    }

    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class);
    }
}
