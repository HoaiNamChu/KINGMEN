<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['status', 'payment_status', 'payment_method',]);
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->decimal('shipping_fee', 10, 2)->nullable();
            $table->decimal('discount', 10, 2)->nullable()->change();
            $table->enum('status', ['Đang chờ xác nhận', 'Đã xác nhận', 'Đang giao hàng', 'Hoàn thành', 'Đã hủy', 'Hoàn đơn', 'Không giao được'])->default('Đang chờ xác nhận');
            $table->enum('payment_status', ['Đã thanh toán', 'Chưa thanh toán']);
            $table->enum('payment_method', ['Cash', 'VN PAY']);
            $table->dropColumn('shipping_method');
            $table->dropColumn('shipping_status');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['status', 'payment_status', 'payment_method',]);
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->string('shipping_status');
            $table->string('shipping_method');
            $table->string('payment_method');
            $table->string('payment_status');
            $table->string('status');
            $table->decimal('discount')->default(0)->change();
            $table->dropColumn('shipping_fee');
            $table->string('email');
        });
    }
};
