<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;


class CartController extends Controller
{

    public function show()
    {
        $cart = auth()->user()->cart;
        return view('client.cart.index', compact('cart'));
    }
    //
    public function addToCart(Request $request, Product $product)
    {
        $cart = auth()->user()->cart;
        $variantId = $request->input('variant_id'); // Nhận variant_id từ request
        $cartItem = $cart->items()
            ->where('product_id', $product->id)
            ->where('variant_id', $variantId) // Kiểm tra biến thể
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1; // Cập nhật số lượng nếu sản phẩm đã tồn tại
            $cartItem->save();
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'variant_id' => $variantId, // Thêm biến thể
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

    public function update(Request $request)
    {
        // Logic cập nhật giỏ hàng
        $quantities = $request->input('quantities', []);
    
        foreach ($quantities as $itemId => $quantity) {
            $cartItem = CartItem::find($itemId);
            if ($cartItem) {
                $cartItem->quantity = $quantity; // Cập nhật số lượng
                $cartItem->save();
            }
        }
    
        return redirect()->route('cart.show')->with('success', 'Giỏ hàng đã được cập nhật.');
    }

    public function removeItem(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }

    public function clear()
    {
        $cart = auth()->user()->cart;

        // Xóa toàn bộ các item trong giỏ hàng
        $cart->items()->delete(); // Xóa tất cả các sản phẩm trong giỏ hàng

        // Chuyển hướng về lại trang giỏ hàng với thông báo
        return redirect()->route('cart.show')->with('success', 'Tất cả sản phẩm trong giỏ hàng đã được xóa.');
    }

}
