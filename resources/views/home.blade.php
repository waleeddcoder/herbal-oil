<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['seo_title'] ?? 'Lumina Herbal' }}</title>
    <meta name="description" content="{{ $settings['seo_description'] ?? '' }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @php
        $primaryColor = $settings['primary_color'] ?? '#2E5A27';
        $accentColor = $settings['accent_color'] ?? '#D8E2DC';
        $bgColor = $settings['bg_color'] ?? '#F9F8F6';
        $siteName = $settings['site_name'] ?? 'Lumina Herbal';
        $buttonText = $settings['button_text'] ?? 'Order Now';
        $whatsapp = $settings['whatsapp_number'] ?? '';
        $supportEmail = 'support' . '@' . strtolower(str_replace(' ', '', $siteName)) . '.com';
    @endphp

    <style>
        :root {
            --brand-primary: {{ $primaryColor }};
            --brand-accent: {{ $accentColor }};
            --brand-bg: {{ $bgColor }};
        }
        body {
            background-color: var(--brand-bg);
            color: #1a1a1a;
            -webkit-font-smoothing: antialiased;
        }
        .text-brand { color: var(--brand-primary); }
        .bg-brand { background-color: var(--brand-primary); }
        .bg-brand-accent { background-color: var(--brand-accent); }

        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
        .reveal-delay-1 { transition-delay: 100ms; }
        .reveal-delay-2 { transition-delay: 200ms; }
        .reveal-delay-3 { transition-delay: 300ms; }

        .btn-primary {
            background-color: var(--brand-primary);
            color: #fff;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(46, 90, 39, 0.4);
        }

        .shadow-premium {
            box-shadow: 0 20px 40px -10px rgba(0,0,0,0.05);
        }

        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="font-sans">

    <!-- Navigation -->
    <nav x-data="{ scrolled: false }" x-on:scroll.window="scrolled = (window.pageYOffset > 20)" x-bind:class="{ 'backdrop-blur-md bg-white/70 shadow-sm': scrolled, 'bg-transparent': !scrolled }" class="fixed w-full z-50 transition-all duration-300 py-4">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <div class="text-2xl font-serif font-medium text-brand tracking-tight">
                {{ $siteName }}
            </div>
            <a href="#order" class="btn-primary px-6 py-2.5 rounded-full text-sm font-medium tracking-wide">
                {{ $buttonText }}
            </a>
        </div>
    </nav>

    <!-- Success Message Modal -->
    @if(session('order_success'))
    <div x-data="{ show: true }" x-show="show" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/40 backdrop-blur-sm px-4">
        <div x-on:click.away="show = false" class="bg-white rounded-2xl p-8 max-w-sm w-full text-center shadow-2xl">
            <div class="w-16 h-16 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-6">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h3 class="text-xl font-serif text-gray-900 mb-2">Order Confirmed</h3>
            <p class="text-gray-500 mb-6">{{ session('order_success') }}</p>
            <button x-on:click="show = false" class="w-full btn-primary py-3 rounded-xl font-medium">Continue</button>
        </div>
    </div>
    @endif

    <!-- Hero Section -->
    <section class="relative pt-24 pb-20 lg:pt-32 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="reveal">
                <div class="inline-flex items-center space-x-2 bg-white px-3 py-1 rounded-full shadow-sm mb-6 border border-gray-100">
                    <span class="flex h-2 w-2 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                    </span>
                    <span class="text-xs font-medium text-gray-600 uppercase tracking-wider">In Stock &amp; Ready to Ship</span>
                </div>
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-serif text-gray-900 leading-[1.1] tracking-tight mb-6">
                    {{ $product?->hero_text ?? 'Premium Herbal Oil' }}
                </h1>
                @if($product?->subheadline)
                <p class="text-lg text-gray-600 mb-10 max-w-lg leading-relaxed">
                    {{ $product->subheadline }}
                </p>
                @endif
                <div class="flex flex-col sm:flex-row gap-4 items-center">
                    <a href="#order" class="w-full sm:w-auto btn-primary px-8 py-4 rounded-xl text-lg font-medium text-center">
                        {{ $buttonText }} — Rs. {{ number_format($product?->price ?? 0, 0) }}
                    </a>
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <span>4.9/5 from 2,000+ reviews</span>
                    </div>
                </div>
            </div>
            <div class="relative reveal reveal-delay-2 h-[500px] lg:h-[700px] rounded-[2.5rem] overflow-hidden shadow-premium group">
                <div class="absolute inset-0 bg-gradient-to-tr from-green-50 to-amber-50"></div>
                @if($product?->images && is_array($product->images) && count($product->images) > 0)
                    <img src="{{ asset('storage/'.$product->images[0]) }}" class="absolute inset-0 w-full h-full object-cover transition duration-700 group-hover:scale-105" alt="{{ $product->name }}" loading="lazy">
                @else
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center">
                            <div class="w-48 h-80 mx-auto rounded-full border-4 border-white shadow-2xl bg-brand-accent/30 backdrop-blur flex items-center justify-center">
                                <span class="text-brand font-serif italic text-2xl">{{ $siteName }}</span>
                            </div>
                            <p class="text-gray-400 text-sm mt-6">Upload product images in admin panel</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Trust Badges -->
    <section class="border-y border-gray-200/50 bg-white/50 backdrop-blur">
        <div class="max-w-7xl mx-auto px-6 py-10 flex flex-wrap justify-center gap-8 md:gap-16 opacity-60 grayscale hover:grayscale-0 transition duration-500">
            <span class="text-lg font-serif italic font-medium">100% Natural</span>
            <span class="text-lg font-serif italic font-medium">Cruelty Free</span>
            <span class="text-lg font-serif italic font-medium">Dermatologist Tested</span>
            <span class="text-lg font-serif italic font-medium">Vegan Formula</span>
        </div>
    </section>

    <!-- Product Intro -->
    <section class="py-24 relative overflow-hidden">
        <div class="max-w-3xl mx-auto px-6 text-center reveal">
            <h2 class="text-3xl lg:text-5xl font-serif text-gray-900 mb-8">{{ $product?->short_description ?? 'The ultimate daily treatment for healthy hair.' }}</h2>
            <p class="text-lg text-gray-600 leading-relaxed">{{ $product?->long_description ?? '' }}</p>
        </div>
    </section>

    <!-- Benefits Section -->
    @if($benefits->isNotEmpty())
    <section class="py-24 bg-white rounded-t-[3rem] lg:rounded-t-[5rem] shadow-[0_-20px_40px_-20px_rgba(0,0,0,0.05)] reveal">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-serif text-gray-900">Why Choose {{ $product?->name ?? 'Our Product' }}</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($benefits as $index => $benefit)
                <div class="p-8 rounded-3xl bg-brand-accent/20 hover:bg-brand-accent/40 transition duration-300 reveal reveal-delay-{{ ($index % 3) + 1 }}">
                    <div class="w-12 h-12 rounded-2xl bg-white shadow-sm flex items-center justify-center text-brand mb-6">
                        @if($benefit->icon === 'leaf')
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21c-4-4-8-7-8-11a8 8 0 0116 0c0 4-4 7-8 11z"/></svg>
                        @elseif($benefit->icon === 'droplet')
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2C12 2 5 10 5 14a7 7 0 0014 0c0-4-7-12-7-12z"/></svg>
                        @elseif($benefit->icon === 'shield')
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        @elseif($benefit->icon === 'sun')
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
                        @else
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        @endif
                    </div>
                    <h3 class="text-xl font-medium text-gray-900 mb-3">{{ $benefit->title }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $benefit->description }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Ingredients Grid -->
    @if($ingredients->isNotEmpty())
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 reveal">
                <div class="max-w-xl">
                    <h2 class="text-4xl font-serif text-gray-900 mb-4">Nothing to Hide</h2>
                    <p class="text-lg text-gray-600">Pure, potent, and ethically sourced botanicals working in perfect harmony.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($ingredients as $index => $ingredient)
                <div class="group relative rounded-3xl overflow-hidden aspect-[4/5] shadow-sm hover:shadow-xl transition-all duration-500 reveal reveal-delay-{{ ($index % 3) + 1 }}">
                    @if($ingredient->image)
                        {{-- Image Card --}}
                        <img src="{{ asset('storage/'.$ingredient->image) }}" class="absolute inset-0 w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition duration-700" alt="{{ $ingredient->name }}" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute inset-x-0 bottom-0 p-8">
                            <h3 class="text-xl font-medium text-white mb-2">{{ $ingredient->name }}</h3>
                            <p class="text-white/80 text-sm leading-relaxed opacity-0 group-hover:opacity-100 transition duration-500 delay-100">{{ $ingredient->description ?? '' }}</p>
                        </div>
                    @else
                        {{-- No-Image Card — clean botanical style --}}
                        @php
                            $gradients = [
                                'from-green-100 to-emerald-50',
                                'from-amber-100 to-yellow-50',
                                'from-teal-100 to-cyan-50',
                                'from-lime-100 to-green-50',
                            ];
                            $gradient = $gradients[$index % count($gradients)];
                        @endphp
                        <div class="absolute inset-0 bg-gradient-to-br {{ $gradient }} group-hover:scale-105 transition duration-700"></div>
                        <div class="relative h-full flex flex-col justify-between p-8">
                            <div class="w-12 h-12 rounded-2xl bg-white/80 shadow-sm flex items-center justify-center text-brand">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21c-4-4-8-7-8-11a8 8 0 0116 0c0 4-4 7-8 11z"/></svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-medium text-gray-900 mb-2">{{ $ingredient->name }}</h3>
                                <p class="text-gray-600 text-sm leading-relaxed">{{ $ingredient->description ?? '' }}</p>
                            </div>
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Before/After (Optional) -->
    @if($product?->show_before_after && !empty($product->before_after_images['before'] ?? null) && !empty($product->before_after_images['after'] ?? null))
    <section class="py-24 bg-white">
        <div class="max-w-5xl mx-auto px-6 text-center reveal">
            <h2 class="text-4xl font-serif text-gray-900 mb-16">Real Results</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-16 items-center">
                <div class="aspect-square rounded-3xl overflow-hidden bg-gray-100 shadow-inner relative">
                    <img src="{{ asset('storage/' . $product->before_after_images['before']) }}" alt="Before" class="w-full h-full object-cover" loading="lazy">
                    <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm px-4 py-1.5 rounded-full text-xs font-semibold text-gray-700 uppercase tracking-wider">Before</div>
                </div>
                <div class="aspect-square rounded-3xl overflow-hidden bg-gray-100 shadow-premium relative">
                    <img src="{{ asset('storage/' . $product->before_after_images['after']) }}" alt="After" class="w-full h-full object-cover" loading="lazy">
                    <div class="absolute bottom-4 left-4 bg-brand/90 backdrop-blur-sm px-4 py-1.5 rounded-full text-xs font-semibold text-white uppercase tracking-wider">After</div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Testimonials Carousel -->
    @if($testimonials->isNotEmpty())
    <section class="py-24 overflow-hidden reveal">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-4xl font-serif text-gray-900 mb-16 text-center">Loved by thousands</h2>

            <div class="flex overflow-x-auto gap-6 pb-12 hide-scrollbar snap-x snap-mandatory" style="scroll-snap-type: x mandatory;">
                @foreach($testimonials as $testimony)
                <div class="snap-center shrink-0 w-[300px] md:w-[400px] bg-white p-8 rounded-3xl shadow-sm ring-1 ring-gray-100">
                    <div class="flex text-yellow-400 mb-6">
                        @for($i=0; $i < ($testimony->rating ?? 5); $i++)
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        @endfor
                    </div>
                    <p class="text-lg text-gray-700 leading-relaxed mb-6 font-serif italic">"{{ $testimony->review }}"</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-brand-accent/50 flex items-center justify-center font-bold text-brand uppercase">
                            {{ substr($testimony->name, 0, 1) }}
                        </div>
                        <div class="font-medium text-gray-900">{{ $testimony->name }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Checkout / Order Form Section -->
    <section id="order" class="py-24 bg-white relative">
        <div class="max-w-4xl mx-auto px-6 reveal">
            <div class="bg-gray-50 rounded-[2.5rem] p-8 md:p-12 shadow-premium border border-gray-100 grid grid-cols-1 md:grid-cols-2 gap-12">

                <div>
                    <h2 class="text-3xl font-serif text-gray-900 mb-4">Secure Your Order</h2>
                    <p class="text-gray-600 mb-8">Direct checkout. No account required. Pay securely upon delivery.</p>

                    <div class="flex items-start gap-4 p-4 bg-white rounded-2xl mb-6 shadow-sm border border-gray-100">
                        <div class="w-16 h-20 bg-brand-accent/20 rounded-xl flex-shrink-0 flex items-center justify-center">
                            <svg class="w-8 h-8 text-brand" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">{{ $product?->name ?? 'Herbal Oil' }}</h4>
                            <p class="text-sm text-gray-500 mt-1">Single Bottle</p>
                            <p class="font-medium text-brand mt-2">Rs. {{ number_format($product?->price ?? 0, 0) }}</p>
                        </div>
                    </div>

                    <ul class="space-y-3 text-sm text-gray-600">
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Free Express Shipping</li>
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> 30-Day Money-Back Guarantee</li>
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Cash on Delivery Available</li>
                    </ul>
                </div>

                <div>
                    @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-xl text-sm border border-red-100">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('checkout.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition">
                        </div>
                        <div>
                            <input type="tel" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition">
                        </div>
                        <div>
                            <input type="text" name="address" placeholder="Delivery Address" value="{{ old('address') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <input type="text" name="city" placeholder="City" value="{{ old('city') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition">
                            </div>
                            <div>
                                <select name="quantity" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition bg-white">
                                    <option value="1">1 Bottle</option>
                                    <option value="2">2 Bottles</option>
                                    <option value="3">3 Bottles</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="w-full btn-primary py-4 rounded-xl font-medium text-lg mt-4 shadow-lg">Complete Order Form</button>
                        <p class="text-xs text-center text-gray-400 mt-4 flex items-center justify-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                            Secure encrypted checkout
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    @if($faqs->isNotEmpty())
    <section class="py-24">
        <div class="max-w-3xl mx-auto px-6 reveal">
            <h2 class="text-4xl font-serif text-gray-900 mb-12 text-center">Frequently Asked Questions</h2>
            <div class="space-y-4">
                @foreach($faqs as $faq)
                <div x-data="{ open: false }" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <button x-on:click="open = !open" class="w-full px-6 py-5 text-left flex justify-between items-center focus:outline-none">
                        <span class="font-medium text-gray-900">{{ $faq->question }}</span>
                        <svg x-bind:class="{'rotate-180': open}" class="w-5 h-5 text-gray-400 transform transition-transform duration-300 shrink-0 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-collapse x-cloak class="px-6 pb-5 text-gray-600 leading-relaxed text-sm">
                        {{ $faq->answer }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16 text-center lg:text-left">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-12 opacity-80">
            <div>
                <div class="text-2xl font-serif font-medium tracking-tight mb-4">{{ $siteName }}</div>
                <p class="text-sm text-gray-400 max-w-xs mx-auto lg:mx-0">{{ $product?->short_description ?? '' }}</p>
            </div>
            <div class="flex justify-center md:justify-start space-x-6 h-fit content-center">
                <a href="#" class="text-gray-400 hover:text-white transition">Instagram</a>
                <a href="#" class="text-gray-400 hover:text-white transition">Facebook</a>
                <a href="#" class="text-gray-400 hover:text-white transition">TikTok</a>
            </div>
            <div class="md:text-right">
                <p class="text-sm text-gray-400 mb-2">Need help?</p>
                <a href="mailto:{{ $supportEmail }}" class="text-white hover:text-green-400 transition block">{{ $supportEmail }}</a>
                @if(!empty($whatsapp))
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}" class="text-white hover:text-green-400 transition block mt-1">{{ $whatsapp }}</a>
                @endif
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 mt-16 pt-8 border-t border-white/10 text-sm text-gray-500 flex flex-col md:flex-row justify-between items-center gap-4">
            <p>&copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.</p>
            <div class="space-x-4">
                <a href="#" class="hover:text-white transition">Privacy</a>
                <a href="#" class="hover:text-white transition">Terms</a>
            </div>
        </div>
    </footer>

    <!-- Scroll Reveal Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: "0px 0px -50px 0px"
            });

            document.querySelectorAll('.reveal').forEach(function(el) {
                observer.observe(el);
            });
        });
    </script>

    <!-- Floating WhatsApp Button -->
    @if(!empty($whatsapp))
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}" target="_blank" class="fixed bottom-6 right-6 w-14 h-14 bg-green-500 rounded-full flex items-center justify-center text-white shadow-[0_10px_20px_-10px_rgba(34,197,94,0.6)] hover:-translate-y-1 hover:shadow-[0_15px_30px_-10px_rgba(34,197,94,0.6)] transition-all duration-300 z-50">
        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.1.824zm-3.423-14.416c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm.029 18.88c-1.161 0-2.305-.292-3.318-.844l-3.677.964.984-3.595c-.607-1.052-.927-2.246-.926-3.468.001-3.825 3.113-6.937 6.937-6.937 3.825 0 6.938 3.112 6.938 6.937 0 3.825-3.113 6.938-6.938 6.938z"/></svg>
    </a>
    @endif
</body>
</html>
