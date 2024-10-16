<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $products = Product::query()->with('category', 'brand')->latest()->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('products'));
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

            $data['slug'] = Str::slug(preg_replace('/[^A-Za-z0-9\s]/', '-', request('name'))).'-'.$data['sku'];;

            $tags = request('tags');
            $galleries = request('galleries');

            try {
                $product = Product::query()->create($data);

                $product->tags()->sync($tags);

                if (!empty($galleries)){
                    foreach ($galleries as $gallery){
                        Gallery::query()->create([
                            'product_id' => $product->id,
                            'image' => Storage::put('galleries', $gallery)
                        ]);
                    }
                }

                return redirect()->route('admin.products.index')->with('success', 'Add Product Successfully');
            }catch (\Exception $exception){
                DB::rollBack();
                return redirect()->route('admin.products.create')->with('error', $exception->getMessage());
            }
        }
        if (request('product_type') === 'variable') {
            $data = [
                'name' => request('name'),
                'sku' => request('sku'),
                'price' => 0,
                'price_sale' =>0,
                'quantity' =>0,
                'description' => request('description'),
                'short_desc' => request('short_desc'),
                'category_id' => request('category_id'),
                'brand_id' => request('brand_id'),
                'is_active' => request('is_active') ?? 0,
                'is_sale' => request('is_sale') ?? 0,
                'is_hot' => request('is_hot') ?? 0,
                'is_home' => request('is_home') ?? 0,
            ];

            if($request->hasFile('image')) {
                $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            }
            $data['image'] ??= null;

            $data['slug'] = Str::slug(preg_replace('/[^A-Za-z0-9\s]/', '-', request('name'))).'-'.$data['sku'];

            $tags = request('tags');
            $galleries = request('galleries');

            $dataVariants = $request->product_variants;

            try {
                DB::beginTransaction();
                $product = Product::query()->create($data);


                foreach ($dataVariants as $key => $dataVariant) {
                    $valueIds = explode('-', $key);
                    array_pop($valueIds);
                    $dataVariant['product_id'] = $product->id;
                    $dataVariant['image'] ??= null;
                    $dataVariant['slug'] = Str::slug(preg_replace('/[^A-Za-z0-9\s]/', '-', request('name'))).'-'.$dataVariant['sku'];
                    if ($dataVariant['image']) {
                        $dataVariant['image'] = Storage::put(self::PATH_UPLOAD, $dataVariant['image']);
                    }
                    $productVariant = Variant::query()->create($dataVariant);
                    $productVariant->attributeValues()->attach($valueIds);


                }


                $product->tags()->sync($tags);

                if (!empty($galleries)){
                    foreach ($galleries as $gallery){
                        Gallery::query()->create([
                            'product_id' => $product->id,
                            'image' => Storage::put(self::PATH_UPLOAD, $gallery)
                        ]);
                    }
                }
                DB::commit();
                return redirect()->route('admin.products.index')->with('success', 'Add Product Successfully');
            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->route('admin.products.create')->with('error', $exception->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $attributes  =  Attribute::query()->pluck('name', 'id');
        $tags        =  Tag::query()->pluck('name', 'id');
        $brands      =  Brand::query()->pluck('name', 'id');
        $categories = Category::query()->whereNull('parent_id')->with('children')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('product', 'attributes', 'tags', 'brands', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->variants->count()) {
            try {

                $product->tags()->detach();

                foreach ( $product->variants as $variant){
                    $variant->attributeValues()->detach();
                }

                $product->variants()->delete();

                $product->delete();

                return redirect()->route('admin.products.index')->with('success', 'Delete Product Successfully');
            }catch (\Exception $exception){
                DB::rollBack();
                return redirect()->route('admin.products.index')->with('error', $exception->getMessage());
            }
        }else{
            try {

                $product->tags()->detach();

                if ($product->galleries->count()){

                    foreach ($product->galleries as $gallery){
                        $gallery->delete();
                        Storage::delete($gallery->image);
                    }
                }

                $product->delete();

                if (!empty($product->image) && Storage::exists($product->image)){
                    Storage::delete($product->image);
                }


                return redirect()->route('admin.products.index')->with('success', 'Delete Product Successfully');
            }catch (\Exception $exception){
                DB::rollBack();
                return redirect()->route('admin.products.index')->with('error', $exception->getMessage());
            }
        }

    }
}
