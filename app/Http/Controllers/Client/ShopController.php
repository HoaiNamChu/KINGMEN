<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    const PATH_VIEW = 'client.shop.';

    public function index(){
        $products = Product::query()
            ->where('is_active', '=',1)
            ->with('categories')
            ->with('variants')
            ->paginate(12);
        $categories = Category::where('is_active', '=', 1)
            ->whereNull('parent_id')
            ->withCount('products')
            ->orderBy('name','ASC')
            ->get();
        $brands = Brand::where('is_active', '=', 1)
            ->withCount('products')
            ->orderBy('name','ASC')
            ->get();
        return view(self::PATH_VIEW.__FUNCTION__, compact('products', 'categories', 'brands'));
    }
}
