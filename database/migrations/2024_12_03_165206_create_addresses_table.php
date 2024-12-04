<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('user_id'); // Foreign Key to users table
            $table->string('nation')->nullable(); // Nation (quốc gia)
            $table->string('city')->nullable(); // City (thành phố)
            $table->string('district')->nullable(); // District (quận/huyện)
            $table->string('ward')->nullable(); // Ward (phường/xã)
            $table->string('detailed_address')->nullable(); // Detailed Address (địa chỉ chi tiết)
            $table->string('phone')->nullable(); // Phone (số điện thoại)
            $table->boolean('is_default')->default(false); // Is Default Address
            $table->timestamps(); // Created at & Updated at

            // Foreign Key Constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
