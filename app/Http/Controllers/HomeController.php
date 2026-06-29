<?php

namespace App\Http\Controllers;

use App\Services\BlogService;
use App\Services\ProductCatalogService;
use Illuminate\View\View;

/**
 * Class HomeController
 *
 * Handles rendering of the public home page.
 *
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Handle the incoming request to view the home page.
     *
     * @param ProductCatalogService $catalogService
     * @param BlogService $blogService
     * @return View
     */
    public function __invoke(ProductCatalogService $catalogService, BlogService $blogService): View
    {
        return view('home', [
            'featuredProducts' => $catalogService->featured(),
            'latestPosts' => $blogService->latest(3),
        ]);
    }
}