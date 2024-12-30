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

    public function index(Request $request)
    {
        $products = Product::where('is_active', '=', 1)
            ->with(['categories', 'variants'])
            ->paginate(12);
        $categories = Category::where('is_active', '=', 1)
            ->whereNull('parent_id')
            ->withCount('products')
            ->orderBy('name', 'ASC')
            ->get();
        $brands = Brand::where('is_active', '=', 1)
            ->withCount('products')
            ->orderBy('name', 'ASC')
            ->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('products', 'categories', 'brands'));
    }

    public function brandFilter(Request $request)
    {
        $products = Product::whereHas('brand', function ($query) use ($request) {
            $query->where('slug', $request->slug);
        })
            ->where('is_active', '=', 1)
            ->with(['categories', 'variants'])
            ->paginate(12);
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

    public function categoryFilter(Request $request)
    {
        $products = Product::whereHas('categories', function ($query) use ($request) {
            $query->where('slug', $request->slug);
        })
            ->where('is_active', '=', 1)
            ->with(['categories', 'variants'])
            ->paginate(12);
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
