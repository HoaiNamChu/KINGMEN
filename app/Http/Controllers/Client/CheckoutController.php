<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Checkouts\CheckoutRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    const PATH_VIEW = 'client.checkout.';


    public function index()
    {
        $data = Auth::user()->load([
            'addresses' => function ($query) {
                $query->where('is_default', 1);
            },
            'cart.cartItems.product',
            'cart.cartItems.variant.attributeValues'
        ]);


        if (!$data->cart->cartItems->count()) {
            return redirect()->back()->with('error', 'Your cart is empty');
        }

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));

    }

    public function order(CheckoutRequest $request)
    {


        $dataOrder = [
            'user_id' => Auth::id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->house_number . ' - ' . $request->ward . ' - ' . $request->district . ' - ' . $request->province,
            'status' => 'Đang chờ xác nhận',
            'discount' => $request->discount,
            'shipping_fee' => $request->shipping_fee,
            'total' => $request->order_total,
            'payment_status' => 'Chưa thanh toán',
        ];
        if ($request->payment_method == 'cash_payment') {
            $dataOrder['payment_method'] = 'Cash';
        } else if ($request->payment_method == 'vnpay_payment') {
            $dataOrder['payment_method'] = 'VN PAY';
        }

        $dataOrderItems = $request->orderItems;

        try {
            $order = Order::query()->create($dataOrder);
            foreach ($dataOrderItems as $orderItem) {
                OrderItem::query()->create([
                    'order_id' => $order->id,
                    'product_id' => $orderItem['product_id'],
                    'variant_id' => $orderItem['variant_id'],
                    'product_name' => $orderItem['product_name'],
                    'product_price' => $orderItem['product_price'],
                    'product_quantity' => $orderItem['product_quantity'],
                    'total_price' => $orderItem['total_price'],
                ]);
            }
            $cart = Cart::query()->where('user_id', \Auth::id())->first();
            $cart->cartItems()->delete();

            if ($request->payment_method == 'vnpay_payment') {

                return redirect($this->vnPayPayment($order));

            }

            return redirect()->route('checkout.return')->with('success', 'Order created!');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }


    }

    public function vnPayPayment($dataOrder)
    {

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = env('APP_URL') . '/checkout/return';
        $vnp_TmnCode = "VE6K2G0A";//Mã website tại VNPAY
        $vnp_HashSecret = "2YZEFBP627O8ZXMP8H5XH0YWF19QXCV1"; //Chuỗi bí mật

        $vnp_TxnRef = $dataOrder->id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toan hoa don';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = intval($dataOrder->total) * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'VNBANK';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {

            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return $vnp_Url;
    }

    public function checkoutReturn(Request $request)
    {

        if ($request->vnp_ResponseCode == '00') {
            Order::query()->where('id', $request->vnp_TxnRef)->update([
                'payment_status' => 'Đã thanh toán',
            ]);
        } else {
            Order::query()->where('id', $request->vnp_TxnRef)->update([
                'payment_status' => 'Chưa thanh toán',
            ]);
        }
        return view('client.vnpay.return');
    }
}
