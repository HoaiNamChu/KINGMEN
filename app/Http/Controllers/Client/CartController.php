<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::query()->where('user_id', Auth::id());

        if ($cart->exists()) {
            $cart->with('cartItems')
                ->with('cartItems.product')
                ->with('cartItems.variant')
                ->with('cartItems.variant.attributeValues:id,name');
        } else {
            $cart = Cart::query()->create([
                'user_id' => Auth::id(),
            ]);
        }
        $attributes = Attribute::query()->with('attributeValues')->get();

        $cart = $cart->first();

        return view('client.cart.index', compact('cart', 'attributes'));
    }

    public function addCart(Request $request)
    {

        $cart = Cart::query()->where('user_id', Auth::id());

        $attributeIds = $request->attribute_id;

        $product = Product::query()->with('variants')->findOrFail($request->product_id);

        if (!$product->variants->count()) {
            $this->iconAddCart($product->slug);
        } else {
            $variant = Variant::where('product_id', $request->product_id)->whereHas('attributeValues', function ($query) use ($attributeIds) {
                $query->whereIn('attribute_values.id', $attributeIds);
            }, '=', count($attributeIds))->with('attributeValues')->get();

            if ($cart->exists()) {
                $cartItem = CartItem::query()->where('cart_id', $cart->first()->id)->where('product_id', $request->product_id)->where('variant_id', $variant->first()->id);
                if ($cartItem->exists()) {
                    $cartItem->update([
                        'quantity' => intval($cartItem->first()->quantity) + intval(request()->quantity)
                    ]);
                } else {
                    CartItem::query()->create([
                        'cart_id' => $cart->first()->id,
                        'product_id' => $request->product_id,
                        'variant_id' => $variant->first()->id,
                        'quantity' => request()->quantity
                    ]);
                }
            } else {
                $cart = Cart::query()->create([
                    'user_id' => Auth::id()
                ]);

                CartItem::query()->create([
                    'cart_id' => $cart->first()->id,
                    'product_id' => $request->product_id,
                    'variant_id' => $variant->first()->id,
                    'quantity' => request()->quantity
                ]);
            }
        }


        return redirect()->route('cart.index')->with('success', 'Add product to cart successfully!');

    }

    public function destroyCart($id)
    {

    }

    public function clearCart()
    {
        $cart = Cart::query()->where('user_id', Auth::id());
        if ($cart->exists()) {
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
                if (request()->quantity) {
                    $cartItem->update([
                        'quantity' => intval($cartItem->first()->quantity) + intval(request()->quantity)
                    ]);
                }else{
                    $cartItem->update([
                        'quantity' => intval($cartItem->first()->quantity) + 1
                    ]);
                }
            } else {
                if (request()->quantity) {
                    CartItem::query()->create([
                        'cart_id' => $cart->first()->id,
                        'product_id' => $product->id,
                        'quantity' => request()->quantity
                    ]);
                }else{
                    CartItem::query()->create([
                        'cart_id' => $cart->first()->id,
                        'product_id' => $product->id,
                        'quantity' => 1
                    ]);
                }
            }
        } else {
            $cart = Cart::query()->create([
                'user_id' => Auth::id()
            ]);
            if (request()->quantity) {

                CartItem::query()->create([
                    'cart_id' => $cart->first()->id,
                    'product_id' => $product->id,
                    'quantity' => request()->quantity
                ]);
            }else{

                CartItem::query()->create([
                    'cart_id' => $cart->first()->id,
                    'product_id' => $product->id,
                    'quantity' => 1
                ]);
            }
        }

        return redirect()->back()->with('success', 'Add product to cart successfully!');
    }
}
