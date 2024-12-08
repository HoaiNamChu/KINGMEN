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
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropConstrainedForeignIdFor(\App\Models\Product::class);
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Product::class)->nullable()->constrained();
            $table->dropColumn('product_status');
            $table->decimal('total_price', 10, 2)->after('product_quantity')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropConstrainedForeignIdFor(\App\Models\Product::class);
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Product::class)->constrained();
            $table->boolean('product_status')->default(0);
            $table->decimal('total_price')->after('product_quantity')->change();
        });
    }
};
