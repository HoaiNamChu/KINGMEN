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
    public function __construct(){
        Auth::loginUsingId(1);
    }
    public function index()
    {
        $cart = Cart::where('user_id', \Auth::id());
        if ($cart->exists()) {
            $cart = $cart->with('cartItems')
                ->with('cartItems.product.attributes')
                ->with('cartItems.product.attributeValues')
                ->with('cartItems.variant.attributeValues')
                ->first();
        } else {
            $cart = Cart::create([
                'user_id' => \Auth::id(),
            ]);

            $cart = $cart->with('cartItems')
                ->with('cartItems.product.attributes')
                ->with('cartItems.product.attributeValues')
                ->with('cartItems.variant.attributeValues')
                ->first();
        }

        return view('client.carts.index', compact('cart'));
    }

}
