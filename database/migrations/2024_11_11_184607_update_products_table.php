<?php

use App\Models\Category;
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
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('brand_id')->nullable()->change();
            $table->dropConstrainedForeignIdFor(Category::class);
            $table->decimal('price', 10, 2)->nullable()->change();
            $table->decimal('price_sale', 10, 2)->nullable()->change();
            $table->boolean('is_new')->default(0);
            $table->boolean('is_featured')->default(0);
            $table->boolean('is_best_seller')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('is_best_seller')->default(0);
            $table->dropColumn('is_featured')->default(0);
            $table->dropColumn('is_new')->default(0);

            $table->decimal('price_sale')->nullable()->change();
            $table->decimal('price')->nullable()->change();
            $table->foreignIdFor(Category::class)->constrained();
            $table->unsignedBigInteger('brand_id')->change();


        });
    }
};
