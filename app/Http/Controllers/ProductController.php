<?php

namespace App\Http\Controllers;

use App\Services\ProductCatalogService;
use Illuminate\View\View;

/**
 * Class ProductController
 *
 * Handles public viewing of outfits / products.
 *
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * Display a listing of all available products.
     *
     * @param  \App\Services\ProductCatalogService  $catalogService
     * @return \Illuminate\View\View
     */
    public function index(ProductCatalogService $catalogService): View
    {
        return view('products.index', [
            'products' => $catalogService->allAvailable(),
        ]);
    }
}