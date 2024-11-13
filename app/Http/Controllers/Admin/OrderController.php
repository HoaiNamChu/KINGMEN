<?php

namespace App\Http\Controllers\Admin;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class OrderController extends Controller
{
    //
    public function index()
    {
        // Lấy tất cả đơn hàng, sắp xếp theo thời gian tạo (mới nhất lên đầu)
        $orders = Order::orderBy('created_at', 'desc')->get();

        // Trả về view với danh sách đơn hàng
        return view('admin.orders.index', compact('orders'));
    }
}
