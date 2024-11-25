<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.order.';

    public function index()
    {
        $orders = Order::query()->with([
            'user',
            'orderItems'
        ])->latest()->paginate(10);
        return view(self::PATH_VIEW . __FUNCTION__, compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        // Lấy thông tin chi tiết của đơn hàng theo order_id
        $order = Order::findOrFail($id);
        $orderItems = $order->orderItems; //lấy hết itemproduct của đơn hàng

        $subtotal = $orderItems->sum('total_price'); //tính subtotal

        $user = User::find($order->user_id); // Lấy thông tin người dùng dựa trên user_id từ bảng orders


        // Trả về kết quả
        return view('admin.orders.detail', compact('orderItems','order','subtotal', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
