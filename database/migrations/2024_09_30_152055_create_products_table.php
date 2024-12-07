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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // $table->foreignIdFor(\App\Models\Category::class)->constrained();
            $table->foreignIdFor(\App\Models\Brand::class)->constrained();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->decimal('price', 19,4)->nullable();
            $table->decimal('price_sale', 19,4)->nullable();
            $table->string('image')->nullable();
            $table->string('short_desc')->nullable();
            $table->text('description')->nullable();
            $table->integer('quantity')->default(0);
            $table->boolean('is_active')->default(1);
            $table->boolean('is_hot')->default(0);
            $table->boolean('is_sale')->default(0);
            $table->boolean('is_home')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
