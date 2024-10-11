<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.products.';
    const PATH_UPLOAD = 'products';

    public function index()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $attributes  =  Attribute::query()->pluck('name', 'id');
        $tags        =  Tag::query()->pluck('name', 'id');
        $brands      =  Brand::query()->pluck('name', 'id');
        $categories = Category::query()->whereNull('parent_id')->with('children')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('attributes', 'tags', 'brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (request('product_type') === 'simple') {
            $data = [
                'name' => request('name'),
                'sku' => request('sku'),
                'price' => request('price'),
                'price_sale' => request('price_sale'),
                'description' => request('description'),
                'short_desc' => request('short_desc'),
                'category_id' => request('category_id'),
                'brand_id' => request('brand_id'),
                'quantity' => request('quantity'),
                'is_active' => request('is_active') ?? 0,
                'is_sale' => request('is_sale') ?? 0,
                'is_hot' => request('is_hot') ?? 0,
                'is_home' => request('is_home') ?? 0,
            ];

            if($request->hasFile('image')) {
                $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            }
            $data['image'] ??= null;

            $data['product_slug'] = Str::slug(preg_replace('/[^A-Za-z0-9\s]/', '-', request('name'))).'-'.$data['sku'];;

            $tags = request('tags');
            $galleries = request('galleries');

            dd($data);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
