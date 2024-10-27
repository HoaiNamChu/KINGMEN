<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index(){
        $carts = DB::table('cart_items')
        ->join('products', 'product_id', '=', 'products.id')
        ->get();
        return view('client.home.index', compact('carts'));
    }

    public function listcart(){
        $carts = DB::table('cart_items')
        ->join('products', 'product_id', '=', 'products.id')
        ->get();
        return view('client.home.listcart', compact('carts'));
    }

    
}
