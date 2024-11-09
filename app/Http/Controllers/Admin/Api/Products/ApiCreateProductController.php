<?php

namespace App\Http\Controllers\Admin\Api\Products;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class ApiCreateProductController extends Controller
{
    public function addAttribute(Request $request)
    {
        $attribute = Attribute::query()->where('id', request('attribute_id'))->where('is_active', '=', 1)->with(['attributeValues' => function ($q) {
            $q->where('is_active', '=', 1);
        }])->first();
//        return view('components.admin.products.product-attribute-value', compact('attribute'));
        return response()->json([
            'attribute' => $attribute,
        ], 200);
    }


    public function addAttributeValue(Request $request)
    {
        $attributeValueIds = request()->input('attributeValueIds');
        $attributeIds = request()->input('attributeIds');

        $attributes = Attribute::query()->whereIn('id', $attributeIds)->with(['attributeValues' => function ($query) use ($attributeValueIds) {
            $query->whereIn('id', $attributeValueIds);
        }])->get();

        return response()->json([
            'attributes' => $attributes,
        ]);

//        $productVariants = $this->generateVariant($attributes);

//        return view('components.admin.products.product-variant', compact('productVariants'));
    }

    private function generateVariant($productAttributes)
    {
        $arrays = [];
        foreach ($productAttributes as $productAttribute) {
            $values = $productAttribute->attributeValues;
            $arrays[] = $values;
        }
//        unset($arrays);
        $filteredArray = array_filter($arrays, function ($collection) {
            return !$collection->isEmpty();
        });
        $results = [[]];
        foreach ($filteredArray as $propertyValues) {
            $newResults = [];
            foreach ($results as $result) {
                foreach ($propertyValues as $value) {
                    $newResults[] = array_merge($result, [$value]);
                }
            }
            $results = $newResults;
        }

        return $results;
    }
}
