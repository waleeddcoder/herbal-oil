<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Lumina Herbal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased flex h-screen overflow-hidden">
    
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-slate-200 flex-shrink-0 flex flex-col hidden md:flex">
        <div class="h-16 flex items-center px-6 border-b border-slate-200">
            <span class="text-xl font-bold tracking-tight text-green-900">Lumina Admin</span>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-green-50 text-green-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">Dashboard</a>
            <a href="{{ route('admin.product.edit') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition {{ request()->routeIs('admin.product.*') ? 'bg-green-50 text-green-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">Product Details</a>
            <a href="{{ route('admin.orders.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition {{ request()->routeIs('admin.orders.*') ? 'bg-green-50 text-green-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">Orders</a>
            <a href="{{ route('admin.ingredients.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition {{ request()->routeIs('admin.ingredients.*') ? 'bg-green-50 text-green-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">Ingredients</a>
            <a href="{{ route('admin.benefits.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition {{ request()->routeIs('admin.benefits.*') ? 'bg-green-50 text-green-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">Benefits</a>
            <a href="{{ route('admin.testimonials.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition {{ request()->routeIs('admin.testimonials.*') ? 'bg-green-50 text-green-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">Testimonials</a>
            <a href="{{ route('admin.faqs.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition {{ request()->routeIs('admin.faqs.*') ? 'bg-green-50 text-green-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">FAQs</a>
            <a href="{{ route('admin.settings.edit') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition {{ request()->routeIs('admin.settings.*') ? 'bg-green-50 text-green-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">Branding & Settings</a>
        </nav>
        <div class="px-4 py-4 border-t border-slate-200">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center px-3 py-2.5 text-sm font-medium text-red-600 rounded-xl hover:bg-red-50 transition">Log out</button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-hidden">
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 flex-shrink-0">
            <h2 class="text-lg font-semibold text-slate-800">@yield('title')</h2>
            <div class="flex items-center space-x-4">
                <a href="{{ route('home') }}" target="_blank" class="text-sm font-medium text-slate-500 hover:text-slate-900 flex items-center gap-2">View Site <span aria-hidden="true">&rarr;</span></a>
            </div>
        </header>
        
        <div class="flex-1 overflow-auto p-8">
            <div class="max-w-7xl mx-auto">
                @if(session('success'))
                    <div class="mb-6 px-4 py-3 bg-[#E8F3EE] text-[#1E3A2F] rounded-xl text-sm font-medium border border-[#D1E8DD] flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-xl text-sm border border-red-100 font-medium">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </main>
</body>
</html>
