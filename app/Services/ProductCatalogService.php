<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductCatalogService
{
    public function allAvailable(): Collection
    {
        return Product::query()->available()->orderBy('name')->get();
    }

    public function featured(int $limit = 3): Collection
    {
        return Product::query()->available()->latest()->limit($limit)->get();
    }
}