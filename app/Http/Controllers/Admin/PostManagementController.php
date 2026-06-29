<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/**
 * Class PostManagementController
 *
 * Handles admin panel CRUD operations for blog posts.
 *
 * @package App\Http\Controllers\Admin
 */
class PostManagementController extends Controller
{
    /**
     * Display a listing of the blog posts in the admin panel.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('admin.posts.index', [
            'posts' => Post::query()->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new blog post.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created blog post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatePost($request);

        Post::query()->create($data);

        return redirect()->route('admin.posts.index')->with('status', 'Post creado correctamente.');
    }

    /**
     * Show the form for editing the specified blog post.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\View\View
     */
    public function edit(Post $post): View
    {
        return view('admin.posts.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified blog post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        $data = $this->validatePost($request, $post);

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('status', 'Post actualizado correctamente.');
    }

    /**
     * Remove the specified blog post from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('status', 'Post eliminado correctamente.');
    }

    /**
     * Validate the request data for a blog post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post|null  $post
     * @return array
     */
    private function validatePost(Request $request, ?Post $post = null): array
    {
        $isCreate = ($post === null);

        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('posts', 'slug')->ignore($post?->id),
            ],
            'excerpt' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'author_name' => ['required', 'string', 'max:120'],
            'category' => ['required', 'string', 'max:120'],
            'image' => $isCreate 
                ? ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048']
                : ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'is_published' => ['nullable', 'boolean'],
            'published_at' => ['nullable', 'date'],
        ];

        $data = $request->validate($rules, [
            'title.required' => 'El título es obligatorio.',
            'excerpt.required' => 'El copete (excerpt) es obligatorio.',
            'content.required' => 'El contenido es obligatorio.',
            'author_name.required' => 'El nombre del autor es obligatorio.',
            'category.required' => 'La categoría es obligatoria.',
            'image.required' => 'La imagen es obligatoria.',
            'image.image' => 'El archivo debe ser una imagen válida.',
            'image.mimes' => 'La imagen debe ser de formato: jpeg, png, jpg, gif, svg, webp.',
            'image.max' => 'La imagen no debe pesar más de 2MB.',
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['is_published'] = $request->boolean('is_published');

        if ($data['is_published'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        if (! $data['is_published']) {
            $data['published_at'] = null;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            
            // Ensure public/uploads directory exists
            $destinationPath = public_path('uploads');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $file->move($destinationPath, $filename);
            $data['image_path'] = 'uploads/' . $filename;
        } elseif ($post) {
            // Keep existing image on update if no new image was uploaded
            $data['image_path'] = $post->image_path;
        }

        // Remove the 'image' file input from $data since DB expects 'image_path'
        unset($data['image']);

        return $data;
    }
}
