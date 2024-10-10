<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index(){
        $carts = DB::table('cart_items')
        ->join('products', 'product_id', '=', 'products.id')
        ->select('cart_items.*','products.name','products.price_sale','products.image')
        ->get();
        return view('client.cart.index', compact('carts'));
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
}
