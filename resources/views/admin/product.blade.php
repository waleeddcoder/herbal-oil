@extends('admin.layout')
@section('title', 'Product Details')

@section('content')
<div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
    <div class="p-6 border-b border-slate-200">
        <h3 class="text-lg font-semibold text-slate-800">Edit Product Information</h3>
        <p class="text-sm text-slate-500 mt-1">Update the main product details displayed on the landing page.</p>
    </div>

    <form action="{{ route('admin.product.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
        @csrf
        @method('PUT')

        <!-- Product Image Upload -->
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-3">Product Image</label>
            <div class="flex flex-col sm:flex-row gap-6 items-start">
                <div class="w-40 h-52 rounded-2xl overflow-hidden bg-slate-100 border-2 border-dashed border-slate-300 flex-shrink-0 relative group">
                    @if($product->images && is_array($product->images) && count($product->images) > 0)
                        <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            <span class="text-white text-xs font-medium">Current Image</span>
                        </div>
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-400">
                            <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z"/></svg>
                            <span class="text-xs">No image</span>
                        </div>
                    @endif
                </div>
                <div class="flex-1 space-y-3">
                    <div class="border-2 border-dashed border-slate-300 rounded-xl p-6 text-center hover:border-green-400 transition cursor-pointer relative">
                        <input type="file" name="product_image" accept="image/jpeg,image/png,image/webp" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <svg class="w-8 h-8 mx-auto text-slate-400 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/></svg>
                        <p class="text-sm text-slate-600 font-medium">Click to upload product image</p>
                        <p class="text-xs text-slate-400 mt-1">JPG, PNG or WebP &bull; Max 2MB</p>
                    </div>
                    @if($product->images && is_array($product->images) && count($product->images) > 0)
                    <label class="flex items-center gap-2 text-sm text-red-600 cursor-pointer">
                        <input type="checkbox" name="remove_image" value="1" class="h-4 w-4 text-red-600 rounded border-slate-300">
                        Remove current image
                    </label>
                    @endif
                    @error('product_image')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <hr class="border-slate-100">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-slate-700">Product Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="mt-1 flex w-full h-11 px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm">
            </div>
            <div>
                <label for="price" class="block text-sm font-medium text-slate-700">Price (Rs.)</label>
                <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}" class="mt-1 flex w-full h-11 px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm">
            </div>
        </div>

        <div>
            <label for="hero_text" class="block text-sm font-medium text-slate-700">Hero Headline</label>
            <input type="text" name="hero_text" id="hero_text" value="{{ old('hero_text', $product->hero_text) }}" class="mt-1 flex w-full h-11 px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm">
        </div>

        <div>
            <label for="subheadline" class="block text-sm font-medium text-slate-700">Hero Subheadline</label>
            <input type="text" name="subheadline" id="subheadline" value="{{ old('subheadline', $product->subheadline) }}" class="mt-1 flex w-full h-11 px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm">
        </div>

        <div>
            <label for="short_description" class="block text-sm font-medium text-slate-700">Short Description</label>
            <textarea name="short_description" id="short_description" rows="3" class="mt-1 flex w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm">{{ old('short_description', $product->short_description) }}</textarea>
        </div>

        <div>
            <label for="long_description" class="block text-sm font-medium text-slate-700">Long Description</label>
            <textarea name="long_description" id="long_description" rows="5" class="mt-1 flex w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm">{{ old('long_description', $product->long_description) }}</textarea>
        </div>

        <hr class="border-slate-100">

        <!-- Before / After Section -->
        <div>
            <div class="flex items-center mb-4">
                <input type="checkbox" name="show_before_after" id="show_before_after" value="1" {{ old('show_before_after', $product->show_before_after) ? 'checked' : '' }} class="h-4 w-4 text-green-600 focus:ring-green-500 border-slate-300 rounded">
                <label for="show_before_after" class="ml-2 block text-sm font-medium text-slate-700">Enable Before/After Section</label>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Before Image --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Before Image</label>
                    <div class="aspect-square rounded-xl overflow-hidden bg-slate-100 border-2 border-dashed border-slate-300 relative group mb-3">
                        @if(!empty($product->before_after_images['before'] ?? null))
                            <img src="{{ asset('storage/' . $product->before_after_images['before']) }}" alt="Before" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <span class="text-white text-sm font-medium">Before</span>
                            </div>
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-400">
                                <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z"/></svg>
                                <span class="text-xs">Before photo</span>
                            </div>
                        @endif
                    </div>
                    <input type="file" name="before_image" accept="image/jpeg,image/png,image/webp" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                </div>

                {{-- After Image --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">After Image</label>
                    <div class="aspect-square rounded-xl overflow-hidden bg-slate-100 border-2 border-dashed border-slate-300 relative group mb-3">
                        @if(!empty($product->before_after_images['after'] ?? null))
                            <img src="{{ asset('storage/' . $product->before_after_images['after']) }}" alt="After" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <span class="text-white text-sm font-medium">After</span>
                            </div>
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-400">
                                <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z"/></svg>
                                <span class="text-xs">After photo</span>
                            </div>
                        @endif
                    </div>
                    <input type="file" name="after_image" accept="image/jpeg,image/png,image/webp" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                </div>
            </div>

            @if(!empty($product->before_after_images['before'] ?? null) || !empty($product->before_after_images['after'] ?? null))
            <label class="flex items-center gap-2 text-sm text-red-600 cursor-pointer mt-3">
                <input type="checkbox" name="remove_before_after" value="1" class="h-4 w-4 text-red-600 rounded border-slate-300">
                Remove all before/after images
            </label>
            @endif
        </div>

        <div class="flex justify-end pt-4 border-t border-slate-100">
            <button type="submit" class="inline-flex items-center px-6 py-2.5 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white bg-green-800 hover:bg-green-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
