<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class BlogService
{
    public function latest(int $limit = 6): Collection
    {
        return Post::query()->published()->limit($limit)->get();
    }

    public function allPublished(): Collection
    {
        return Post::query()->published()->get();
    }
}