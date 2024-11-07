<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    const PATH_VIEW = 'client.product.';

    public function detail($slug){
        $product = Product::where('slug', $slug)
            ->with('categories', 'variants', 'brand', 'galleries', 'reviews')
            ->first();
        $attributes = Attribute::query()->with('attributeValues')->get();
        return view(self::PATH_VIEW . 'detail', compact('product', 'attributes'));
    }
}
