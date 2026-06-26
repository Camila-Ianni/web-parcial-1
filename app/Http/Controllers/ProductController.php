<?php

namespace App\Http\Controllers;

use App\Services\ProductCatalogService;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(ProductCatalogService $catalogService): View
    {
        return view('products.index', [
            'products' => $catalogService->allAvailable(),
        ]);
    }
}