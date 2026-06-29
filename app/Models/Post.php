<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 *
 * Represents a blog post in the system.
 *
 * @package App\Models
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $excerpt
 * @property string $content
 * @property string $author_name
 * @property string $category
 * @property string|null $image_path
 * @property bool $is_published
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'author_name',
        'category',
        'image_path',
        'is_published',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    /**
     * Scope a query to only include published blog posts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->latest('published_at');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Calculate approximate reading time for the blog post.
     *
     * @return int
     */
    public function readingTimeMinutes(): int
    {
        $words = str_word_count(strip_tags($this->content));

        return max(1, (int) ceil($words / 180));
    }
}
