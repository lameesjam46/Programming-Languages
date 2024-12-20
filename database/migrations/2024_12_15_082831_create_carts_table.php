<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_color_size_id')->constrained('product_color_sizes')->cascadeOnUpdate()->cascadeOnDelete();
//            $table->foreignId('product_id')->constrained('products')->cascadeOnUpdate()->cascadeOnDelete();
//            $table->foreignId('color_id')->constrained('colors')->cascadeOnDelete()->cascadeOnUpdate();
//            $table->foreignId('size_id')->constrained('sizes')->cascadeOnUpdate()->cascadeOnDelete();
//            $table->decimal('price');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
