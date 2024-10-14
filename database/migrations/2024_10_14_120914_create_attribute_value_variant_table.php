<?php

use App\Models\AttributeValue;
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
        Schema::create('attribute_value_variant', function (Blueprint $table) {
            $table->foreignIdFor(AttributeValue::class)->constrained();
            $table->foreignIdFor(\App\Models\Variant::class)->constrained();

            $table->primary(['attribute_value_id', 'variant_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_value_variant');
    }
};
