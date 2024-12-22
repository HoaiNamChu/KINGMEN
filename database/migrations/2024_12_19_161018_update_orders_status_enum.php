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
        //
        Schema::table('orders', function (Blueprint $table) {
            // Sử dụng raw SQL để thêm giá trị enum mới
            DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('Đang chờ xác nhận', 'Đã xác nhận', 'Đang giao hàng', 'Hoàn thành', 'Đã hủy', 'Hoàn đơn', 'Không giao được', 'Đơn yêu cầu hoàn trả') DEFAULT 'Đang chờ xác nhận'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('orders', function (Blueprint $table) {
            // Sử dụng raw SQL để xóa giá trị enum mới
            DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('Đang chờ xác nhận', 'Đã xác nhận', 'Đang giao hàng', 'Hoàn thành', 'Đã hủy', 'Hoàn đơn', 'Không giao được') DEFAULT 'Đang chờ xác nhận'");
        });
    }
};
