<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'postsCount' => Post::query()->count(),
            'productsCount' => Product::query()->count(),
            'usersCount' => User::query()->count(),
        ]);
    }
}
