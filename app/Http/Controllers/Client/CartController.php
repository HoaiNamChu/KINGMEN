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
        $variantId = $request->input('variant_id'); // Nhận variant_id từ request

        if (auth()->check()) {
            // Người dùng đã đăng nhập, sử dụng giỏ hàng trong database
            $cart = auth()->user()->cart;

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
        } else {
            // Người dùng chưa đăng nhập, sử dụng giỏ hàng lưu trong session
            $cart = session()->get('cart', []);

            $cartKey = $product->id . '-' . $variantId; // Tạo key để xác định sản phẩm và biến thể

            if (isset($cart[$cartKey])) {
                // Sản phẩm đã tồn tại trong giỏ hàng session, tăng số lượng
                $cart[$cartKey]['quantity'] += 1;
            } else {
                // Sản phẩm chưa có, thêm vào giỏ hàng session
                $cart[$cartKey] = [
                    'product_id' => $product->id,
                    'variant_id' => $variantId,
                    'name' => $product->name, // Thêm thông tin sản phẩm (tùy chỉnh theo yêu cầu)
                    'price' => $product->price,
                    'quantity' => 1,
                ];
            }

            // Lưu lại giỏ hàng trong session
            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
        }
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

    public function transferSessionCartToDatabase()
{
    // Kiểm tra nếu session có giỏ hàng
    $sessionCart = session()->get('cart', []);

    if (!empty($sessionCart)) {
        // Lấy giỏ hàng của người dùng từ database
        $cart = auth()->user()->cart;

        foreach ($sessionCart as $item) {
            // Kiểm tra xem sản phẩm và biến thể đã có trong giỏ hàng database chưa
            $cartItem = $cart->items()
                ->where('product_id', $item['product_id'])
                ->where('variant_id', $item['variant_id'])
                ->first();

            if ($cartItem) {
                // Nếu sản phẩm đã có trong giỏ hàng, tăng số lượng
                $cartItem->quantity += $item['quantity'];
                $cartItem->save();
            } else {
                // Nếu chưa có, thêm mới vào giỏ hàng database
                $cart->items()->create([
                    'product_id' => $item['product_id'],
                    'variant_id' => $item['variant_id'],
                    'quantity' => $item['quantity'],
                ]);
            }
        }

        // Xóa giỏ hàng session sau khi chuyển sang database
        session()->forget('cart');
    }
}


}
