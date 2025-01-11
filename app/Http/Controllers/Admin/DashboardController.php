<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        return view('admin.dashboard.index', compact('totalOrders')); // Trả về view với dữ liệu
    }

    public function getRevenueData(Request $request)
    {
        $orders = DB::table('orders')
            ->selectRaw('DATE(created_at) as date, SUM(total) as revenue')
            ->where('status', 'Hoàn thành')
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy(DB::raw('DATE(created_at)'))
            ->get();

        return response()->json($orders);
    }

}
