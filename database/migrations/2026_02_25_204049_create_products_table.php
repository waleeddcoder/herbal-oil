<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->string('hero_text');
            $table->string('subheadline')->nullable();
            $table->text('short_description');
            $table->longText('long_description');
            $table->json('images')->nullable();
            $table->json('before_after_images')->nullable();
            $table->boolean('show_before_after')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('products');
    }
};
