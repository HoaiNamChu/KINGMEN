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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->string('status');
            $table->string('payment_method');
            $table->boolean('payment_status')->default(0);
            $table->string('shipping_method');
            $table->decimal('shipping_fee', 19,2)->default(0);
            $table->string('shipping_status');
            $table->text('note')->nullable();
            $table->decimal('discount',19,2)->default(0);
            $table->decimal('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
