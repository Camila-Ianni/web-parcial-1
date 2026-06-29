<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\BlogService;
use Illuminate\View\View;

/**
 * Class PostController
 *
 * Handles public viewing of blog posts.
 *
 * @package App\Http\Controllers
 */
class PostController extends Controller
{
    /**
     * Display a listing of the published blog posts.
     *
     * @param  \App\Services\BlogService  $blogService
     * @return \Illuminate\View\View
     */
    public function index(BlogService $blogService): View
    {
        return view('posts.index', [
            'posts' => $blogService->allPublished(),
        ]);
    }

    /**
     * Display a single specified blog post.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\View\View
     */
    public function show(Post $post): View
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }
}