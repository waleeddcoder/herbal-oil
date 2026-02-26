@extends('admin.layout')
@section('title', 'Branding & Settings')

@section('content')
<div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
    <div class="p-6 border-b border-slate-200">
        <h3 class="text-lg font-semibold text-slate-800">Site Configuration</h3>
        <p class="text-sm text-slate-500 mt-1">Manage global site branding, colors, and SEO metadata.</p>
    </div>
    
    <form action="{{ route('admin.settings.update') }}" method="POST" class="p-6 space-y-8">
        @csrf
        @method('PUT')
        
        <!-- General Info -->
        <div>
            <h4 class="text-md font-medium text-slate-900 border-b border-slate-100 pb-2 mb-4">General Information</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="site_name" class="block text-sm font-medium text-slate-700">Site Name</label>
                    <input type="text" name="site_name" id="site_name" value="{{ old('site_name', $settings['site_name'] ?? '') }}" class="mt-1 flex w-full h-11 px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm">
                </div>
                <div>
                    <label for="whatsapp_number" class="block text-sm font-medium text-slate-700">WhatsApp Number (Optional)</label>
                    <input type="text" name="whatsapp_number" id="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number'] ?? '') }}" class="mt-1 flex w-full h-11 px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm" placeholder="+1234567890">
                </div>
            </div>
        </div>

        <!-- Branding Colors -->
        <div>
            <h4 class="text-md font-medium text-slate-900 border-b border-slate-100 pb-2 mb-4">Branding Colors</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="primary_color" class="block text-sm font-medium text-slate-700">Primary Color</label>
                    <div class="mt-1 flex items-center space-x-3">
                        <input type="color" name="primary_color" id="primary_color" value="{{ old('primary_color', $settings['primary_color'] ?? '#2E5A27') }}" class="h-11 w-11 rounded border border-slate-200 cursor-pointer">
                        <input type="text" value="{{ old('primary_color', $settings['primary_color'] ?? '#2E5A27') }}" class="flex-1 h-11 px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm" readonly>
                    </div>
                </div>
                <div>
                    <label for="accent_color" class="block text-sm font-medium text-slate-700">Accent Color</label>
                    <div class="mt-1 flex items-center space-x-3">
                        <input type="color" name="accent_color" id="accent_color" value="{{ old('accent_color', $settings['accent_color'] ?? '#D8E2DC') }}" class="h-11 w-11 rounded border border-slate-200 cursor-pointer">
                        <input type="text" value="{{ old('accent_color', $settings['accent_color'] ?? '#D8E2DC') }}" class="flex-1 h-11 px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm" readonly>
                    </div>
                </div>
                <div>
                    <label for="bg_color" class="block text-sm font-medium text-slate-700">Background Color</label>
                    <div class="mt-1 flex items-center space-x-3">
                        <input type="color" name="bg_color" id="bg_color" value="{{ old('bg_color', $settings['bg_color'] ?? '#F9F8F6') }}" class="h-11 w-11 rounded border border-slate-200 cursor-pointer">
                        <input type="text" value="{{ old('bg_color', $settings['bg_color'] ?? '#F9F8F6') }}" class="flex-1 h-11 px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm" readonly>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- UI Elements -->
        <div>
            <h4 class="text-md font-medium text-slate-900 border-b border-slate-100 pb-2 mb-4">UI Elements</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="button_text" class="block text-sm font-medium text-slate-700">Call-To-Action Button Text</label>
                    <input type="text" name="button_text" id="button_text" value="{{ old('button_text', $settings['button_text'] ?? 'Order Now') }}" class="mt-1 flex w-full h-11 px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm">
                </div>
            </div>
        </div>

        <!-- SEO -->
        <div>
            <h4 class="text-md font-medium text-slate-900 border-b border-slate-100 pb-2 mb-4">SEO Metadata</h4>
            <div class="space-y-4">
                <div>
                    <label for="seo_title" class="block text-sm font-medium text-slate-700">Meta Title</label>
                    <input type="text" name="seo_title" id="seo_title" value="{{ old('seo_title', $settings['seo_title'] ?? '') }}" class="mt-1 flex w-full h-11 px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm">
                </div>
                <div>
                    <label for="seo_description" class="block text-sm font-medium text-slate-700">Meta Description</label>
                    <textarea name="seo_description" id="seo_description" rows="3" class="mt-1 flex w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm">{{ old('seo_description', $settings['seo_description'] ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-4 border-t border-slate-100">
            <button type="submit" class="inline-flex items-center px-6 py-2.5 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white bg-green-800 hover:bg-green-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                Save Configurations
            </button>
        </div>
    </form>
</div>
<script>
    // Sync text inputs with color pickers visually when changed (via standard JS or Alpine)
    // For simplicity, just read value. But the text inputs are readonly so they update the color picker values.
    document.querySelectorAll('input[type="color"]').forEach(picker => {
        picker.addEventListener('input', function() {
            this.nextElementSibling.value = this.value;
        });
    });
</script>
@endsection
