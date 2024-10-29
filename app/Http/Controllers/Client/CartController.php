<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::query()->where('user_id', Auth::id())->with('cartItems')->first();
        return view('client.cart.index', compact('cart'));
    }

    public function addCart(Request $request) 
    {

    }

    public function destroyCart($id)
    {
        
    }

    public function clearCart()
    {
        $cart = Cart::query()->where('user_id', Auth::id());
        if($cart->exists()){
            CartItem::query()->where('cart_id', $cart->first()->id)->delete();
        }
        return redirect()->route('cart.index')->with('success', 'Clear cart successfully!');
    }

    public function updateCart(Request $request)
    {
        $data = [
            'quantity' => $request['quantity']
        ];
        DB::table('cart_items')->update($data);
        return back();
    }

    public function iconAddCart($slug)
    {
        $product = Product::query()->where('slug', $slug)->first();

        $cart = Cart::query()->where('user_id', Auth::id());

        if ($cart->exists()) {
            $cartItem = CartItem::query()->where('cart_id', $cart->first()->id)->where('product_id', $product->id);
            if ($cartItem->exists()) {
                $cartItem->update([
                    'quantity' => intval($cartItem->first()->quantity) + 1
                ]);
            } else {
                CartItem::query()->create([
                    'cart_id' => $cart->first()->id,
                    'product_id' => $product->id,
                    'quantity' => 1
                ]);
            }
        } else {
            $cart = Cart::query()->create([
                'user_id' => Auth::id()
            ]);

            CartItem::query()->create([
                'cart_id' => $cart->first()->id,
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Add product to cart successfully!');
    }
}
