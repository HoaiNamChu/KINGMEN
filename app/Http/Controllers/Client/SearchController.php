<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    const PATH_VIEW = 'client.shop.';

    public function search(Request $request)
    {
        $products = Product::where('name', 'like', "%".$request->query('q') ."%")
            ->where('is_active', '=', 1)
            ->with(['categories', 'variants'])
            ->paginate(12)->appends($request->query());

        $categories = Category::where('is_active', '=', 1)
            ->whereNull('parent_id')
            ->withCount('products')
            ->orderBy('name', 'ASC')
            ->get();

        $brands = Brand::where('is_active', '=', 1)
            ->withCount('products')
            ->orderBy('name', 'ASC')
            ->get();

        return view(self::PATH_VIEW . 'index', compact('products', 'categories', 'brands'));
    }

}
