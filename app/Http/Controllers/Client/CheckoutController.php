<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    //

    public function index()
    {
        $cart = Cart::query()->where('user_id', Auth::id())
            ->with('cartItems.product')
            ->with('cartItems.variant.attributeValues')
            ->first();
        if (!$cart->cartItems->count()){
            return redirect()->back()->with('error', 'Your cart is empty');
        }
        return view('client.checkout.index', compact('cart'));
    }
}
