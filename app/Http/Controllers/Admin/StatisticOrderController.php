<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticOrderController extends Controller
{
    //
    public function statistics(Request $request)
    {

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $orders = collect();
        if ($startDate && $endDate) {
            $orders = Order::whereBetween('created_at', [$startDate, $endDate])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        // Tính doanh thu hiện tại (tổng tiền từ các đơn đã hoàn thành)
        $currentRevenue = Order::where('status', 'Hoàn thành')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->sum('total');

        // Tính doanh thu dự kiến (tổng tiền từ tất cả các đơn, trừ đơn bị hủy)
        $expectedRevenue = Order::where('status', '!=', 'Đã hủy')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->sum('total');

        // Logic thống kê tổng quan (tùy chọn)
        $statistics = [
            'totalOrders' => Order::count(),
            'completedOrders' => Order::where('status', 'Hoàn thành')->count(),
            'cancelledOrders' => Order::where('status', 'Đã hủy')->count(),
            'pendingOrders' => Order::where('status', 'Đang giao hàng')->count(),
        ];

        return view('admin.dashboard.statisticOrder', compact('orders', 'statistics', 'startDate', 'endDate','currentRevenue','expectedRevenue'));
    }
}
