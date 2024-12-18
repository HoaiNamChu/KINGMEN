<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticOrderController extends Controller
{
    //
    public function statistics()
{
    // Thống kê số đơn hàng theo ngày
    $ordersByDay = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
        ->groupBy('date')
        ->orderBy('date', 'desc')
        ->get();

    // Thống kê số đơn hàng theo tháng
    $ordersByMonth = Order::select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'), DB::raw('count(*) as total'))
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();

    // Thống kê số đơn hàng theo năm
    $ordersByYear = Order::select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as total'))
        ->groupBy('year')
        ->orderBy('year', 'desc')
        ->get();

    // Trả về view với dữ liệu thống kê
    return view('admin.dashboard.statisticOrder', compact('ordersByDay', 'ordersByMonth', 'ordersByYear'));
}
}
