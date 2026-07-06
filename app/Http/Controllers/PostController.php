<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\BlogService;
use Illuminate\View\View;


class PostController extends Controller
{
    
    public function index(BlogService $blogService): View
    {
        return view('posts.index', [
            'posts' => $blogService->allPublished(),
        ]);
    }

    
    public function show(Post $post): View
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }
}