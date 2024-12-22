<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;


class OrderClientController extends Controller
{
    //

    //index viết trong accountGoogle

    public function show($id)
    {
        // Lấy đơn hàng của người dùng hiện tại, bao gồm các sản phẩm trong bảng order_items

        $order = Order::where('id', $id)
            ->with([
                'orderItems.product',
                'orderItems.variant'
            ])->first(); // Lấy đơn hàng cùng với các item    $orders = $user->orders;

        //        $subtotal = $order->orderItems->sum('total_price'); // Lấy tổng giá trị 'total' của tất cả các mục

        // Trả về view chi tiết đơn hàng với thông tin đơn hàng và các items
        return view('client.order.detail', compact('order'));
    }

    public function cancel($id)
    {
        // Lấy đơn hàng của người dùng với id được chỉ định
        $order = auth()->user()->orders()->findOrFail($id);

        // Kiểm tra nếu trạng thái của đơn hàng là "Chờ xác nhận" thì mới có thể hủy
        if ($order->status == 'Đang chờ xác nhận') {
            // Cập nhật trạng thái của đơn hàng thành "Đã hủy"
            $order->status = 'Đã hủy';
            $order->save(); // Lưu lại thay đổi vào cơ sở dữ liệu

            // Trả về thông báo thành công
            return redirect()->route('account.index')->with('success', 'Đơn hàng đã được hủy thành công.');
        }

        // Nếu đơn hàng không thể hủy, trả về thông báo lỗi
        return redirect()->route('order.detail', $id)->with('error', 'Không thể hủy đơn hàng này.');
    }
}
