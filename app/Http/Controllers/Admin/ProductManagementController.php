<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/**
 * Class ProductManagementController
 *
 * Handles admin panel CRUD operations for products / outfits.
 *
 * @package App\Http\Controllers\Admin
 */
class ProductManagementController extends Controller
{
    /**
     * Display a listing of products in the admin panel.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('admin.products.index', [
            'products' => Product::query()->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateProduct($request);

        Product::query()->create($data);

        return redirect()->route('admin.products.index')->with('status', 'Outfit creado correctamente.');
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View
     */
    public function edit(Product $product): View
    {
        return view('admin.products.edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $this->validateProduct($request, $product);

        $product->update($data);

        return redirect()->route('admin.products.index')->with('status', 'Outfit actualizado correctamente.');
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('status', 'Outfit eliminado correctamente.');
    }

    /**
     * Validate the request data for a product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product|null  $product
     * @return array
     */
    private function validateProduct(Request $request, ?Product $product = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('products', 'slug')->ignore($product?->id),
            ],
            'description' => ['required', 'string'],
            'category' => ['required', 'string', 'max:120'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:4096'],
            'is_active' => ['nullable', 'boolean'],
            'garments' => ['nullable', 'array'],
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active');

        // Handle main image file upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $filename);
            $data['image_path'] = 'uploads/' . $filename;
        } elseif ($product) {
            $data['image_path'] = $product->image_path;
        } else {
            $data['image_path'] = $request->input('image_path') ?: 'img/outfit1.png';
        }
        unset($data['image']);

        // Handle garments images and fields
        $garmentsData = [];
        if ($request->has('garments') && is_array($request->input('garments'))) {
            foreach ($request->input('garments') as $index => $garment) {
                $garmentData = [
                    'title' => $garment['title'] ?? '',
                    'desc' => $garment['desc'] ?? '',
                    'price' => $garment['price'] ?? '',
                    'style' => $garment['style'] ?? '',
                    'src' => $garment['existing_src'] ?? 'img/top1.png',
                ];

                // Handle file upload for this individual garment
                if ($request->hasFile("garments.{$index}.image")) {
                    $file = $request->file("garments.{$index}.image");
                    $filename = time() . '_garment_' . $index . '_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
                    
                    $destinationPath = public_path('uploads');
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0755, true);
                    }
                    
                    $file->move($destinationPath, $filename);
                    $garmentData['src'] = 'uploads/' . $filename;
                }

                $garmentsData[] = $garmentData;
            }
        }
        $data['garments'] = $garmentsData;

        return $data;
    }
}
