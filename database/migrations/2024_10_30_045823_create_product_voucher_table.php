<?php

use App\Models\Product;
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
        Schema::create('product_voucher', function (Blueprint $table) {
            $table->foreignIdFor(Product::class)->constrained();
            $table->foreignIdFor(\App\Models\Voucher::class)->constrained();

            $table->primary(['product_id', 'voucher_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_voucher');
    }
};
