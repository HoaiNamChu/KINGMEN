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
        Schema::create('chat_rooms', function (Blueprint $table) {
            $table->id();

            $table->string('chat_session_id')->nullable();
            $table->foreignId('customer_id')->nullable()->constrained('users')->onDelete('set null');;
            $table->string('customer_name', 50);
            $table->string('customer_email', 50);
            $table->string('customer_phone', 20);

            $table->foreignId('staff_id')->nullable()->constrained('users')->onDelete('set null');;

            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_rooms');
    }
};
