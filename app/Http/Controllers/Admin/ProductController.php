<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function edit()
    {
        $product = Product::firstOrFail();
        return view('admin.product', compact('product'));
    }

    public function update(Request $request)
    {
        $product = Product::firstOrFail();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'hero_text' => 'required|string|max:255',
            'subheadline' => 'nullable|string|max:255',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'show_before_after' => 'boolean',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'remove_image' => 'nullable|boolean',
            'before_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'after_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'remove_before_after' => 'nullable|boolean',
        ]);

        // Handle product image
        $images = $product->images ?? [];

        if ($request->hasFile('product_image')) {
            if (!empty($images)) {
                foreach ($images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            $path = $request->file('product_image')->store('products', 'public');
            $images = [$path];
        }

        if ($request->boolean('remove_image')) {
            if (!empty($images)) {
                foreach ($images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            $images = [];
        }

        // Handle before/after images
        $beforeAfter = $product->before_after_images ?? [];

        if ($request->hasFile('before_image')) {
            if (!empty($beforeAfter['before'] ?? null)) {
                Storage::disk('public')->delete($beforeAfter['before']);
            }
            $beforeAfter['before'] = $request->file('before_image')->store('products/before-after', 'public');
        }

        if ($request->hasFile('after_image')) {
            if (!empty($beforeAfter['after'] ?? null)) {
                Storage::disk('public')->delete($beforeAfter['after']);
            }
            $beforeAfter['after'] = $request->file('after_image')->store('products/before-after', 'public');
        }

        if ($request->boolean('remove_before_after')) {
            if (!empty($beforeAfter['before'] ?? null)) {
                Storage::disk('public')->delete($beforeAfter['before']);
            }
            if (!empty($beforeAfter['after'] ?? null)) {
                Storage::disk('public')->delete($beforeAfter['after']);
            }
            $beforeAfter = [];
        }

        $product->update([
            'name' => $data['name'],
            'price' => $data['price'],
            'hero_text' => $data['hero_text'],
            'subheadline' => $data['subheadline'] ?? null,
            'short_description' => $data['short_description'],
            'long_description' => $data['long_description'],
            'show_before_after' => $request->has('show_before_after'),
            'images' => $images,
            'before_after_images' => $beforeAfter,
        ]);

        return redirect()->back()->with('success', 'Product details updated successfully.');
    }
}
