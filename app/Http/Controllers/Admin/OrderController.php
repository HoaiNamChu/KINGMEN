<?php

namespace App\Http\Controllers\Admin;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Validation\Rule;
use App\Models\User;

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
    $order = Order::findOrFail($id);
    $orderItems = $order->orderItems; //lấy hết itemproduct của đơn hàng

        $subtotal = $orderItems->sum('total_price'); //tính subtotal

        $user = User::find($order->user_id); // Lấy thông tin người dùng dựa trên user_id từ bảng orders


    // Trả về kết quả
    return view('admin.orders.detail', compact('orderItems','order','subtotal', 'user'));

}


public function updateStatus(Request $request, $id)
{
    // Lấy đơn hàng từ database
    $order = Order::findOrFail($id);

    // Các quy tắc chuyển đổi trạng thái
    $validTransitions = [
        'Đang chờ xác nhận' => ['Đã xác nhận', 'Đã hủy', 'Hoàn thành','Đang giao hàng', 'Hoàn đơn', 'Không giao được'],
        'Đã xác nhận' => ['Chờ xác nhận', 'Đã hủy', 'Hoàn thành','Đang giao hàng', 'Hoàn đơn', 'Không giao được'],
        'Đang giao hàng' => ['Đã xác nhận', 'Đã hủy', 'Hoàn thành','Đã xác nhận', 'Hoàn đơn', 'Không giao được'],
        'Hoàn thành' => [], // Không cho phép thay đổi nếu đã hoàn thành
        'Đã hủy' => [], // Không cho phép thay đổi nếu đã hủy
        'Hoàn đơn' => [], // Không cho phép thay đổi nếu đã hoàn đơn
        'Không giao được' => [], // Không cho phép thay đổi nếu không giao được
    ];

    // Validate trạng thái mới
    $request->validate([
        'status' => [
            'required',
            Rule::in($validTransitions[$order->status] ?? []),
        ],
    ], [
        'status.in' => 'Không chuyển được trạng thái đơn hàng.',
    ]);

    // Cập nhật trạng thái nếu hợp lệ
    $order->status = $request->input('status');

    $order->save();
    //nếu trạng thái đơn hàng == hoàn thành thì đổi trạng thái thanh toán thành 'đã thanh toán'
    if($order->status == 'Hoàn thành'){
        $order->update(['paymemnt_status'=>'Đã thanh toán']);
    }

    return redirect()->route('admin.orders.show', $id)
                     ->with('success', 'Trạng thái đơn hàng đã được cập nhật thành công.');
}


}
