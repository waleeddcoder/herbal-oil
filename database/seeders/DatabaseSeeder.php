<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Faq;
use App\Models\Benefit;
use App\Models\Ingredient;
use App\Models\Testimonial;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        // General Settings
        $settings = [
            'site_name' => 'Lumina Herbal',
            'primary_color' => '#2E5A27', // Earthy Green
            'accent_color' => '#D8E2DC', // Warm Beige
            'bg_color' => '#F9F8F6', // Soft White
            'button_text' => 'Order Now',
            'whatsapp_number' => '+1234567890',
            'logo_path' => null,
            'seo_title' => 'Lumina Herbal - Premium Hair Oil',
            'seo_description' => 'Discover the secret to perfect hair with Lumina Herbal.',
        ];
        foreach ($settings as $key => $value) {
            Setting::create(['key' => $key, 'value' => $value]);
        }

        // Single Product
        Product::create([
            'name' => 'Lumina Botanical Elixir',
            'price' => 2499,
            'hero_text' => 'Nature’s pure essence for extraordinary hair.',
            'subheadline' => 'Crafted with 14 organic botanicals to restore shine, stimulate growth, and protect your scalp.',
            'short_description' => 'The ultimate daily treatment for healthy, luxurious hair.',
            'long_description' => 'Experience the power of nature with our meticulously crafted formulation. Cold-pressed to preserve nutrient density, Lumina Botanical Elixir penetrates deep to revitalize follicles from the inside out.',
            'show_before_after' => true,
        ]);

        // Benefits
        $benefits = [
            ['title' => 'Stimulates Growth', 'description' => 'Activates dormant follicles with potent phyto-nutrients.', 'icon' => 'leaf'],
            ['title' => 'Deep Hydration', 'description' => 'Locks in moisture without leaving greasy residue.', 'icon' => 'droplet'],
            ['title' => 'Strengthens Roots', 'description' => 'Fortifies hair structure to prevent breakage.', 'icon' => 'shield'],
            ['title' => 'Soothes Scalp', 'description' => 'Calms irritation and eliminates dryness naturally.', 'icon' => 'sun'],
        ];
        foreach ($benefits as $index => $b) {
            Benefit::create(array_merge($b, ['sort_order' => $index]));
        }

        // Ingredients
        $ingredients = [
            ['name' => 'Moroccan Argan', 'description' => 'Liquid gold for legendary shine and softness.'],
            ['name' => 'Rosemary Extract', 'description' => 'Clinically proven to enhance hair thickness.'],
            ['name' => 'Jojoba Oil', 'description' => 'Mimics natural sebum for perfect balance.'],
            ['name' => 'Black Seed Oil', 'description' => 'Ancient secret for resilient, strong hair.'],
        ];
        foreach ($ingredients as $index => $i) {
            Ingredient::create(array_merge($i, ['sort_order' => $index]));
        }

        // FAQs
        $faqs = [
            ['question' => 'How often should I use it?', 'answer' => 'For best results, massage into scalp 2-3 times a week, leaving it on for at least 30 minutes before washing.'],
            ['question' => 'Is it suitable for colored hair?', 'answer' => 'Yes! Our formula is 100% natural, sulfate-free, and perfectly safe for color-treated hair.'],
            ['question' => 'How long until I see results?', 'answer' => 'Most customers notice increased softness immediately, with visible growth improvements after 4-6 weeks of consistent use.'],
        ];
        foreach ($faqs as $index => $f) {
            Faq::create(array_merge($f, ['sort_order' => $index]));
        }

        // Testimonials
        $testimonials = [
            ['name' => 'Sarah Jenkins', 'review' => 'Absolutely transformed my hair. It has never felt so thick and luxurious!', 'rating' => 5],
            ['name' => 'Emily Chen', 'review' => 'The only oil that doesn\'t weigh my fine hair down. Smells divine too.', 'rating' => 5],
            ['name' => 'Jessica Alba', 'review' => 'My shedding stopped within two weeks. I am a customer for life.', 'rating' => 5],
        ];
        foreach ($testimonials as $index => $t) {
            Testimonial::create(array_merge($t, ['sort_order' => $index]));
        }
    }
}
