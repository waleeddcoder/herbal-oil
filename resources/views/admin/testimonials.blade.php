@extends('admin.layout')
@section('title', 'Manage Testimonials')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Add New Form -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-200 overflow-hidden sticky top-6">
            <div class="p-6 border-b border-slate-200 bg-slate-50/50">
                <h3 class="text-lg font-semibold text-slate-800">Add Testimonial</h3>
            </div>
            <form action="{{ route('admin.testimonials.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-700">Customer Name</label>
                    <input type="text" name="name" required class="mt-1 block w-full h-11 px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Review</label>
                    <textarea name="review" rows="3" required class="mt-1 block w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 text-sm"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Rating (1-5)</label>
                        <input type="number" name="rating" value="5" min="1" max="5" class="mt-1 block w-full h-11 px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Sort Order</label>
                        <input type="number" name="sort_order" value="0" class="mt-1 block w-full h-11 px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 text-sm">
                    </div>
                </div>
                <button type="submit" class="w-full py-2.5 px-4 bg-green-800 text-white rounded-xl font-medium hover:bg-green-900 transition">Add Testimonial</button>
            </form>
        </div>
    </div>

    <!-- List -->
    <div class="lg:col-span-2 space-y-4">
        @foreach($testimonials as $testimony)
        <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-200 p-6 flex flex-col sm:flex-row gap-6 items-start sm:items-center">
            
            <form action="{{ route('admin.testimonials.update', $testimony) }}" method="POST" class="flex-1 grid grid-cols-1 sm:grid-cols-12 gap-4 items-center w-full">
                @csrf
                @method('PUT')
                
                <div class="sm:col-span-3">
                    <input type="text" name="name" value="{{ $testimony->name }}" required class="block w-full h-10 px-3 bg-slate-50 border border-slate-200 rounded-lg text-sm font-medium">
                </div>
                <div class="sm:col-span-5">
                    <input type="text" name="review" value="{{ $testimony->review }}" required class="block w-full h-10 px-3 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-500">
                </div>
                <div class="sm:col-span-1">
                    <input type="number" name="rating" value="{{ $testimony->rating }}" min="1" max="5" class="block w-full h-10 px-3 bg-slate-50 border border-slate-200 rounded-lg text-sm text-center">
                </div>
                <div class="sm:col-span-1">
                    <input type="number" name="sort_order" value="{{ $testimony->sort_order }}" class="block w-full h-10 px-3 bg-slate-50 border border-slate-200 rounded-lg text-sm text-center">
                </div>
                
                <div class="sm:col-span-2 flex justify-end">
                    <button type="submit" class="text-green-600 hover:text-green-800 font-medium text-sm p-2 bg-green-50 rounded-lg shrink-0">Save</button>
                </div>
            </form>

            <form action="{{ route('admin.testimonials.destroy', $testimony) }}" method="POST" class="shrink-0" onsubmit="return confirm('Delete this testimonial?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700 p-2 bg-red-50 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </form>
        </div>
        @endforeach
        
        @if($testimonials->isEmpty())
        <div class="text-center p-12 bg-slate-50 rounded-2xl border border-dashed border-slate-300">
            <div class="text-slate-500 font-medium">No testimonials added yet.</div>
        </div>
        @endif
    </div>
</div>
@endsection
