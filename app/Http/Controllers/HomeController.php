<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Benefit;
use App\Models\Ingredient;
use App\Models\Testimonial;
use App\Models\Faq;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::first();
        $settings = Setting::pluck('value', 'key')->toArray();
        $benefits = Benefit::orderBy('sort_order')->get();
        $ingredients = Ingredient::where('is_active', true)->orderBy('sort_order')->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('sort_order')->get();
        $faqs = Faq::where('is_active', true)->orderBy('sort_order')->get();

        return view('home', compact('product', 'settings', 'benefits', 'ingredients', 'testimonials', 'faqs'));
    }
}
