<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    const PATH_VIEW = 'client.shop.';

    public function index(){
        $products = Product::query()
            ->where('is_active', '=',1)
            ->with('categories')
            ->paginate(12);
        return view(self::PATH_VIEW.__FUNCTION__, compact('products'));
    }
}
