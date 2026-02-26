@extends('admin.layout')
@section('title', 'Manage Ingredients')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    <!-- Add New Form -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-200 overflow-hidden sticky top-6">
            <div class="p-6 border-b border-slate-200 bg-slate-50/50">
                <h3 class="text-lg font-semibold text-slate-800">Add Ingredient</h3>
            </div>
            <form action="{{ route('admin.ingredients.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-700">Name</label>
                    <input type="text" name="name" required class="mt-1 block w-full h-11 px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Description</label>
                    <textarea name="description" rows="3" class="mt-1 block w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 text-sm"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Image</label>
                    <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="mt-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                    <p class="text-xs text-slate-400 mt-1">JPG, PNG or WebP • Max 2MB</p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Sort Order</label>
                        <input type="number" name="sort_order" value="0" class="mt-1 block w-full h-11 px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 text-sm">
                    </div>
                    <div class="flex items-center pt-6">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 text-green-600 border-slate-300 rounded focus:ring-green-500">
                            <span class="text-sm font-medium text-slate-700">Active</span>
                        </label>
                    </div>
                </div>
                <button type="submit" class="w-full py-2.5 px-4 bg-green-800 text-white rounded-xl font-medium hover:bg-green-900 transition">Add Ingredient</button>
            </form>
        </div>
    </div>

    <!-- List -->
    <div class="lg:col-span-2">
        <div class="space-y-4 h-[calc(100vh-12rem)] overflow-y-auto pr-2 pb-10" style="scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent;">
            @foreach($ingredients as $ingredient)
            <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-200 p-6 {{ !$ingredient->is_active ? 'opacity-60' : '' }}">
                <form action="{{ route('admin.ingredients.update', $ingredient) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col sm:flex-row gap-5 items-start">
                        {{-- Image Preview --}}
                        <div class="w-20 h-20 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0 border border-slate-200">
                            @if($ingredient->image)
                                <img src="{{ asset('storage/' . $ingredient->image) }}" alt="{{ $ingredient->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-300">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z"/></svg>
                                </div>
                            @endif
                        </div>

                        {{-- Fields --}}
                        <div class="flex-1 grid grid-cols-1 sm:grid-cols-12 gap-3 items-center w-full">
                            <div class="sm:col-span-3">
                                <input type="text" name="name" value="{{ $ingredient->name }}" required class="block w-full h-10 px-3 bg-slate-50 border border-slate-200 rounded-lg text-sm font-medium" placeholder="Name">
                            </div>
                            <div class="sm:col-span-4">
                                <input type="text" name="description" value="{{ $ingredient->description }}" class="block w-full h-10 px-3 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-500" placeholder="Description">
                            </div>
                            <div class="sm:col-span-3">
                                <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="block w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-medium file:bg-slate-100 file:text-slate-700">
                            </div>
                            <div class="sm:col-span-1 flex justify-center">
                                <label class="flex items-center justify-center cursor-pointer" title="Active Status">
                                    <input type="checkbox" name="is_active" value="1" {{ $ingredient->is_active ? 'checked' : '' }} class="w-5 h-5 text-green-600 border-slate-300 rounded focus:ring-green-500">
                                </label>
                            </div>
                            <div class="sm:col-span-1 flex justify-end">
                                <button type="submit" class="text-green-600 hover:text-green-800 font-medium text-sm px-3 py-2 bg-green-50 rounded-lg shrink-0">Save</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="flex justify-between items-center mt-3 pt-3 border-t border-slate-100">
                    <div class="text-xs text-slate-400">Sort order: <span class="font-medium">{{ $ingredient->sort_order }}</span></div>
                    <form action="{{ route('admin.ingredients.destroy', $ingredient) }}" method="POST" onsubmit="return confirm('Delete this ingredient?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-medium flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            @endforeach

            @if($ingredients->isEmpty())
            <div class="text-center p-12 bg-slate-50 rounded-2xl border border-dashed border-slate-300">
                <div class="text-slate-500 font-medium">No ingredients added yet.</div>
            </div>
            @endif
        </div>
</div>
@endsection
