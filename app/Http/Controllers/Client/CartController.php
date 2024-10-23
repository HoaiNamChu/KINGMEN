<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;


class CartController extends Controller
{
    //
    public function addToCart(Request $request)
    {
        $userId = auth()->id(); // Lấy ID người dùng nếu đã đăng nhập
        
        // Tìm hoặc tạo giỏ hàng mới
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        // Thêm sản phẩm vào giỏ hàng
        $cartItem = $cart->items()->create([
            'product_id' => $request->product_id,
            'variant_id' => $request->variant_id,
            'quantity' => $request->quantity,
        ]);

        return response()->json(['message' => 'Sản phẩm đã được thêm vào giỏ hàng', 'cart_item' => $cartItem]);
    }

    public function showCart()
{
    $userId = auth()->id();
    $cart = Cart::where('user_id', $userId)->with('items.product', 'items.variant')->first();

    return view('client.cart.index', compact('cart'));
}

public function updateCartItem(Request $request, $itemId)
{
    $cartItem = CartItem::findOrFail($itemId);
    $cartItem->quantity = $request->quantity;
    $cartItem->save();

    return response()->json(['message' => 'Cập nhật số lượng thành công']);
}

public function removeCartItem($itemId)
{
    $cartItem = CartItem::findOrFail($itemId);
    $cartItem->delete();

    return response()->json(['message' => 'Sản phẩm đã được xóa khỏi giỏ hàng']);
}

}
