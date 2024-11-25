<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    const PATH_VIEW = 'client.products.';

    public function productDetail(Request $request)
    {
        $product = Product::query()
            ->with('attributes.attributeValues')
            ->with('attributeValues')
            ->with('variants.attributeValues')
            ->with('categories')
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

    public function variantInformation(Request $request)
    {

        $attributeID = $request->attributeValueID;

        $variant = Variant::where('product_id', '=', $request->product_id)
            ->whereHas('attributeValues', function ($query) use ($attributeID) {
            $query->whereIn('attribute_values.id', $attributeID);
        }, '=', count($attributeID))
            ->withCount('attributeValues')
            ->having('attribute_values_count', '=', count($attributeID))
            ->get();


        return response()->json([
            'data' => $variant
        ], 200);
    }
}
