<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;

class CartController extends Controller
{

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

    public function store(Request $request)
    {
        $product = Product::where('id', $request->product_id)->with('variants')->first();

        if ($product->variants->count() > 0) {
            $attributeID = request('attribute');

            if ($attributeID){
                $variant = Variant::where('product_id', '=', $request->product_id)
                    ->whereHas('attributeValues', function ($query) use ($attributeID) {
                        $query->whereIn('attribute_values.id', $attributeID);
                    }, '=', count($attributeID))
                    ->withCount('attributeValues')
                    ->having('attribute_values_count', '=', count($attributeID))
                    ->first();

                $data = [
                    'product_id' => $product->id,
                    'variant_id' => $variant->id,
                    'quantity' => $request->quantity,
                ];
            }else{
                return redirect()->back()->with('error', 'Please choose product variant first');
            }
        }else{
            $data = [
                'product_id' => $product->id,
                'variant_id' => null,
                'quantity' => $request->quantity,
            ];
        }

        $cart = Cart::where('user_id', \Auth::id());

        if ($cart->exists()) {
            $data['cart_id'] = $cart->first()->id;
            $cartItem = CartItem::where('cart_id', $cart->first()->id)
            ->where('product_id', $data['product_id'])
            ->where('variant_id', $data['variant_id']);
            if ($cartItem->exists()){
                $cartItem->update(['quantity' => intval($cartItem->first()->quantity) + intval($data['quantity'])]);
            }else{
                CartItem::create($data);
            }
        } else {
            $cart = Cart::create([
                'user_id' => \Auth::id(),
            ]);

            $data['cart_id'] = $cart->first()->id;
            CartItem::create($data);
        }


        return redirect()->route('cart.index')->with('success', 'Added to cart');

    }


    public function update(Request $request)
    {
        $cartItem = CartItem::where('id',request('id'))
            ->with('product')
            ->with('variant')
            ->first();;
        $cartItem->update(['quantity' => request('quantity')]);

        return response()->json([
            'data' => $cartItem
        ], 200);
    }


    public function destroy(Request $request)
    {

        $cartItem = CartItem::find(request('id'));
        $cartItem->delete();

        return response()->json([
           'data' => $cartItem
        ], 200);
    }

    public function clear(Request $request)
    {
        $cart  = Cart::where('user_id', \Auth::id())->where('id', $request->id)->first();
        $cart->cartItems()->delete();

        return redirect()->route('cart.index')->with('success', 'Removed from cart');
    }
}
