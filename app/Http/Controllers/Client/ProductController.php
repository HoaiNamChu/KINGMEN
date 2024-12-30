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
        $product = Product::with([
            'variants.attributeValues.attribute',
            'categories',
            'brand',
            'galleries'
        ])->where('slug', $request->slug)->first();


        $productAttributes = $product->variants->flatMap(function ($variant) {
            return $variant->attributeValues->pluck('attribute');
        })->unique('id');

        $productAttributeValues = [];

        foreach ($productAttributes as $attribute) {
            $values = $product->variants->flatMap(function ($variant) use ($attribute) {
                return $variant->attributeValues->where('attribute_id', $attribute->id);
            })->unique();

            $productAttributeValues = $values;
        }

        $relatedProducts = Product::query()
            ->where('id', '!=', $product->id)
            ->where('is_active', '=', 1)
            ->where('brand_id', '=', $product->brand_id)
            ->with([
                'variants',
                'categories',
            ])
            ->latest()
            ->limit(8)
            ->get();

        return view(self::PATH_VIEW . 'product-detail', compact('product', 'relatedProducts', 'productAttributes', 'productAttributeValues'));
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

    public function show($id)
    {
        $product = Product::query()
            ->where('id', $id)
            ->with('attributes.attributeValues')
            ->first();

        return response()->json([
            'product' => $product
        ]);
    }
}
