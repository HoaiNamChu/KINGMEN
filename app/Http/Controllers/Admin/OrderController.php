<?php

namespace App\Http\Controllers\Admin;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Validation\Rule;


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

    public function show($id)
{
    // Lấy thông tin chi tiết của đơn hàng theo order_id
    $orders = Order::where('id',$id)->get();
    $orderItems = OrderItem::where('order_id', $id)
        ->select(
            'id',
            'order_id',
            'product_id',
            'product_name',
            'product_price',
            'product_quantity',
            'product_image',
            'discount',
            'total_price',
            'created_at',
            'updated_at'
        )
        ->get();

    // Trả về kết quả

    return view('admin.orders.detail', compact('orderItems','orders'));

}


public function update(Request $request, $id)
{
    // Lấy đơn hàng từ database
    $order = Order::findOrFail($id);

    // Các quy tắc chuyển đổi trạng thái
    $validTransitions = [
        'Đang chờ xác nhận' => ['Đã xác nhận', 'Đã hủy'],
        'Đã xác nhận' => ['Đang giao hàng'],
        'Đang giao hàng' => ['Hoàn thành', 'Không giao được'],
        'Hoàn thành' => [], // Không cho phép thay đổi nếu đã hoàn thành
        'Đã hủy' => [], // Không cho phép thay đổi nếu đã hủy
        'Hoàn đơn' => [], // Không cho phép thay đổi nếu đã hoàn đơn
        'Không giao được' => [], // Không cho phép thay đổi nếu không giao được
    ];

    // Kiểm tra giá trị 'status' đầu vào
    $request->validate([
        'status' => [
            'required',
            Rule::in($validTransitions[$order->status] ?? []),
        ],
    ], [
        'status.in' => 'Không thể chuyển trạng thái.',
    ]);

    // Cập nhật trạng thái nếu hợp lệ
    $order->status = $request->input('status');
    $order->save();

    return redirect()->route('admin.orders.show', $id)
    ->with('success', 'Trạng thái đơn hàng đã được cập nhật thành công.');
}


}
