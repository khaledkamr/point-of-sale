<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->string('sku')->nullable();       // Stock Keeping Unit
            $table->string('img_url')->nullable();
            $table->text('description')->nullable();
            $table->decimal('profit_margin', 5, 2);
            $table->string('unit')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('active')->default(true);
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
