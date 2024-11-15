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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id(); // Tạo trường ID tự động tăng
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Liên kết với bảng users
            $table->string('subject'); // Chủ đề
            $table->text('message'); // Nội dung yêu cầu
            $table->enum('status', ['new', 'in_progress', 'resolved', 'closed'])->default('new'); // Trạng thái
            $table->timestamps(); // Thêm created_at và updated_at
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
