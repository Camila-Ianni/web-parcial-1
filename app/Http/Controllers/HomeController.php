<?php

namespace App\Http\Controllers;

use App\Services\BlogService;
use App\Services\ProductCatalogService;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(ProductCatalogService $catalogService, BlogService $blogService): View
    {
        return view('home', [
            'featuredProducts' => $catalogService->featured(),
            'latestPosts' => $blogService->latest(3),
        ]);
    }
}