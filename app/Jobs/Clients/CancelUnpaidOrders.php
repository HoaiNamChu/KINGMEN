<?php

namespace App\Jobs\Clients;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class CancelUnpaidOrders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $timeout = Carbon::now()->subMinutes(30);
        $orders = Order::where('payment_status', 'Chưa thanh toán')
            ->whereNotIn('status', ['Đã hủy', 'Hoàn đơn', 'Không giao được', 'Đơn yêu cầu hoàn trả', 'Hoàn thành'])
            ->where('payment_method', 'VN PAY')
            ->where('created_at', '<=', $timeout)
            ->get();

        foreach ($orders as $order) {
            $order->update(['status' => 'Đã hủy']);
        }
    }
}
