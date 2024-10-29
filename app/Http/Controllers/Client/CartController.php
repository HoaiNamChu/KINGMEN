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
    public function index(){
        $carts = Cart::query()->where('user_id', Auth::id())->first();
        $cartItems = CartItem::query()->where('cart_id', $carts->id)->with('product')->get();
        return view('client.cart.index', compact('cartItems'));
    }

    public function addCart(Request $request){
        $dataCart = [
            'user_id' => 1
        ];
        $cart = Cart::query()->create($dataCart);
        $dataCartItem = [
            'cart_id' => $cart->id,
            'product_id' => 1,
            'quantity' => 1
        ];
        $cartItem = CartItem::query()->create($dataCartItem);
        return redirect()->route('cart.index');
    }

    public function destroyCart($id){
        // dd($id);
        $cartItem = CartItem::query()->findOrFail($id);
        $cartItem->delete();
        return back();
    }

    public function destroyAllCart(){
        CartItem::query()->delete();
        return back();
    }

    public function updateCart(Request $request){
        $data = [
            'quantity' => $request['quantity']
        ];
        DB::table('cart_items')->update($data);
        return back();
    }

    public function addCartIcon($slug)
    {
        Auth::loginUsingId(1);
        $product = Product::query()->where('slug',$slug)->first();
       if (!Cart::query()->where('user_id',Auth::id())->exists()) {
           $cart = Cart::query()->create([
              'user_id' => Auth::id(),
          ]);
       }
       $cart = Cart::query()->where('user_id', Auth::id())->first();
       if (CartItem::query()->where('product_id',$product->id)->exists()){
           $cartItem = CartItem::query()->where('product_id',$product->id)->first();
           $cartItem->update([
               'quantity' => $cartItem->quantity+=1
           ]);
       }else{
           $cartItem = CartItem::query()->create([
               'cart_id' => $cart->id,
               'product_id' => $product->id,
               'quantity' => 1
           ]);
       }

       return redirect()->back()->with('success', 'Add product to cart successfully!');
    }
}
