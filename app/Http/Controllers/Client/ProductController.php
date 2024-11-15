<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    const PATH_VIEW = 'client.products.';

    public function productDetail(Request $request)
    {
        $product = Product::query()
            ->where('slug', $request->slug)
            ->first();
        $relatedProducts = Product::query()
            ->where('id', '!=', $product->id)
            ->where('brand_id', $product->brand_id)
            ->where('is_active', '=', 1)
            ->latest()
            ->limit(8)
            ->get();
        return view(self::PATH_VIEW . 'product-detail', compact('product', 'relatedProducts'));
    }
}
