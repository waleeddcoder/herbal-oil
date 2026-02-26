<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Storage;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::orderBy('sort_order')->get();
        return view('admin.ingredients', compact('ingredients'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('ingredients', 'public');
        }

        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        Ingredient::create($data);
        return redirect()->back()->with('success', 'Ingredient added successfully.');
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($ingredient->image) {
                Storage::disk('public')->delete($ingredient->image);
            }
            $data['image'] = $request->file('image')->store('ingredients', 'public');
        }

        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $ingredient->update($data);
        return redirect()->back()->with('success', 'Ingredient updated successfully.');
    }

    public function destroy(Ingredient $ingredient)
    {
        if ($ingredient->image) {
            Storage::disk('public')->delete($ingredient->image);
        }
        $ingredient->delete();
        return redirect()->back()->with('success', 'Ingredient deleted.');
    }
}
