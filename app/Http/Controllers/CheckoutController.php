<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //
    public function checkout(Request $request){

        dd($request);
        return view('client.home.orders.checkout');
    }
}