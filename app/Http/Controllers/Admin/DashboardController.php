<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getMonthlyRevenue(Request $request)
{
    $month = $request->input('month');
    $year = $request->input('year');

    // Lấy tất cả các đơn hàng trong tháng và năm đã chọn
    $orders = Order::whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
        ->get();

    // Tính tổng doanh thu cho tháng đó chỉ từ các đơn hàng có trạng thái 'hoàn thành'
    $totalRevenue = $orders->where('status', 'hoàn thành')->sum('total_amount');

    return view('admin.dashboard.index', compact('orders', 'totalRevenue')); // Trả về view với dữ liệu
}



}
