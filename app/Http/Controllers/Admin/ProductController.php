<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('images')->latest();

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        $products = $query->paginate(20);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|in:men,women,pants,oneset',
            'subcategory' => 'nullable|string|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'sizes' => 'required|array|min:1',
            'sizes.*' => 'in:S,M,L,XL,XXL,XXXL',
            'is_new' => 'boolean',
            'is_sale' => 'boolean',
            'is_preorder' => 'boolean',
            'preorder_duration' => 'nullable|integer|min:1|max:90',
            'sale_price' => 'nullable|numeric|min:0',
            'sale_start' => 'nullable|date',
            'sale_end' => 'nullable|date|after:sale_start',
        ]);

        $data = $request->except(['image', 'sizes']);
        
        // Handle sizes - store as JSON
        $data['available_sizes'] = json_encode($request->sizes);

        // Handle main image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = Str::slug($request->name) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('products', $filename, 'public');
            $data['image'] = $filename;
        }

        // Set defaults for checkboxes
        $data['is_new'] = $request->has('is_new') ? 1 : 0;
        $data['is_sale'] = $request->has('is_sale') ? 1 : 0;
        $data['is_preorder'] = $request->has('is_preorder') ? 1 : 0;

        // Clear preorder_duration if not preorder
        if (!$data['is_preorder']) {
            $data['preorder_duration'] = null;
        }

        $product = Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        $product->load(['images', 'variants']);
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|in:men,women,pants,oneset',
            'subcategory' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'sizes' => 'required|array|min:1',
            'sizes.*' => 'in:S,M,L,XL,XXL,XXXL',
            'is_new' => 'boolean',
            'is_sale' => 'boolean',
            'is_preorder' => 'boolean',
            'preorder_duration' => 'nullable|integer|min:1|max:90',
            'sale_price' => 'nullable|numeric|min:0',
            'sale_start' => 'nullable|date',
            'sale_end' => 'nullable|date|after:sale_start',
        ]);

        $data = $request->except(['image', 'sizes']);
        
        // Handle sizes - store as JSON
        $data['available_sizes'] = json_encode($request->sizes);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::disk('public')->delete('products/' . $product->image);
            }

            $image = $request->file('image');
            $filename = Str::slug($request->name) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('products', $filename, 'public');
            $data['image'] = $filename;
        }

        // Set defaults for checkboxes
        $data['is_new'] = $request->has('is_new') ? 1 : 0;
        $data['is_sale'] = $request->has('is_sale') ? 1 : 0;
        $data['is_preorder'] = $request->has('is_preorder') ? 1 : 0;

        // Clear preorder_duration if not preorder
        if (!$data['is_preorder']) {
            $data['preorder_duration'] = null;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        // Delete images
        if ($product->image) {
            Storage::disk('public')->delete('products/' . $product->image);
        }

        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }

    public function uploadImages(Request $request, Product $product)
    {
        $request->validate([
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = $product->id . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('products/gallery', $filename, 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'products/gallery/' . $filename,
                    'is_primary' => false,
                ]);
            }
        }

        return back()->with('success', 'Images uploaded successfully!');
    }

    public function deleteImage(Product $product, ProductImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Image deleted successfully!');
    }
}