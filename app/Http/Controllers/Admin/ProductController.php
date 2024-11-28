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
use Illuminate\Support\Arr;
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
        $products = Product::query()->with('categories', 'brand', 'reviews')->latest()->paginate(10);
        return view(self::PATH_VIEW . __FUNCTION__, compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $attributes = Attribute::query()
            ->where('is_active', '=', 1)
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');

        $tags = Tag::query()
            ->where('is_active', '=', 1)
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');

        $brands = Brand::query()
            ->where('is_active', '=', 1)
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');

        $categories = Category::query()
            ->whereNull('parent_id')
            ->where('is_active', '=', 1)
            ->with(['children' => function ($q) {
                $q->where('is_active', '=', 1)->orderBy('name', 'ASC');
            }])
            ->orderBy('name', 'ASC')
            ->get();

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
                'price_import' => request('price_import') ?? 0,
                'price' => request('price') ?? 0,
                'price_sale' => request('price_sale') ?? 0,
                'description' => request('description'),
                'short_desc' => request('short_desc'),
                'brand_id' => request('brand_id'),
                'quantity' => request('quantity') ?? 0,
                'is_active' => request('is_active') ?? 0,
                'is_featured' => request('is_featured') ?? 0,
                'is_new' => request('is_new') ?? 0,
                'is_sale' => request('is_sale') ?? 0,
                'is_hot' => request('is_hot') ?? 0,
                'is_home' => request('is_home') ?? 0,
                'is_best_seller' => request('is_best_seller') ?? 0,
            ];

            if ($request->hasFile('image')) {
                $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            }
            $data['image'] ??= null;

            $data['slug'] = Str::slug(preg_replace('/[^A-Za-z0-9\s]/', '-', request('name'))) . '-' . $data['sku'];;

            $categories = request('category_id');
            $tags = request('tags');
            $galleries = request('galleries');

            try {
                $product = Product::query()->create($data);

                $product->tags()->sync($tags);
                $product->categories()->sync($categories);

                if (!empty($galleries)) {
                    foreach ($galleries as $gallery) {
                        Gallery::query()->create([
                            'product_id' => $product->id,
                            'image' => Storage::put('galleries', $gallery)
                        ]);
                    }
                }

            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->route('admin.products.create')->with('error', $exception->getMessage());
            }
        }
        if (request('product_type') === 'variable') {
            $data = [
                'name' => request('name'),
                'sku' => request('sku'),
                'price_import' => request('price_import') ?? 0,
                'price' => 0,
                'price_sale' => 0,
                'quantity' => 0,
                'description' => request('description'),
                'short_desc' => request('short_desc'),
                'brand_id' => request('brand_id'),
                'is_active' => request('is_active') ?? 0,
                'is_featured' => request('is_featured') ?? 0,
                'is_new' => request('is_new') ?? 0,
                'is_sale' => request('is_sale') ?? 0,
                'is_hot' => request('is_hot') ?? 0,
                'is_home' => request('is_home') ?? 0,
                'is_best_seller' => request('is_best_seller') ?? 0,
            ];

            if ($request->hasFile('image')) {
                $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            }
            $data['image'] ??= null;

            $data['slug'] = Str::slug(preg_replace('/[^A-Za-z0-9\s]/', '-', request('name'))) . '-' . $data['sku'];

            $tags = request('tags');
            $categories = request('category_id');
            $galleries = request('galleries');

            $dataVariants = $request->product_variants;

//            dd($dataVariants);

            try {

                $product = Product::query()->create($data);

                $product->categories()->sync($categories);

                $product->tags()->sync($tags);

                $attributeValueId = [];

                foreach ($dataVariants as $key => $dataVariant) {
                    $valueIds = explode('-', $key);

                    array_pop($valueIds);
                    foreach ($valueIds as $value) {
                        $attributeValueId[] = $value;
                    }
                    $dataVariant['product_id'] = $product->id;
                    $dataVariant['image'] ??= null;
                    $dataVariant['slug'] = Str::slug(preg_replace('/[^A-Za-z0-9\s]/', '-', request('name'))) . '-' . $dataVariant['sku'];
                    if ($dataVariant['image']) {
                        $dataVariant['image'] = Storage::put(self::PATH_UPLOAD, $dataVariant['image']);
                    }
                    $productVariant = Variant::query()->create($dataVariant);
                    $productVariant->attributeValues()->attach($valueIds);

                }

                $newAttributeValueId = array_unique($attributeValueId);

                $attributeId = [];

                $product->attributeValues()->sync($newAttributeValueId);

                foreach ($product->attributeValues as $item) {
                    $attributeId[] = $item->attribute_id;
                }

                $newAttributeId = array_unique($attributeId);

                $product->attributes()->sync($newAttributeId);

                $maxPrice = 0;

                $minPrice = [];

                foreach ($product->variants as $variant) {
                    if ($product->is_sale) {
                        $minPrice[] = $variant->price_sale;

                        if (intval($maxPrice) < intval($variant->price_sale)) {
                            $maxPrice = intval($variant->price_sale);
                        }
                    } else {

                        $minPrice[] = $variant->price;

                        if (intval($maxPrice) < intval($variant->price)) {
                            $maxPrice = intval($variant->price);
                        }
                    }

                }

                $product->update([
                    'price' => $maxPrice,
                    'price_sale' => min($minPrice),
                ]);



                if (!empty($galleries)) {
                    foreach ($galleries as $gallery) {
                        Gallery::query()->create([
                            'product_id' => $product->id,
                            'image' => Storage::put(self::PATH_UPLOAD, $gallery)
                        ]);
                    }
                }

            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->route('admin.products.create')->with('error', $exception->getMessage());
            }
        }
        return redirect()->route('admin.products.index')->with('success', 'Add Product Successfully');
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
//        dd($product);

        $attributes = Attribute::query()
            ->where('is_active', '=', 1)
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');

        $tags = Tag::query()
            ->where('is_active', '=', 1)
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');

        $brands = Brand::query()
            ->where('is_active', '=', 1)
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');

        $categories = Category::query()
            ->whereNull('parent_id')
            ->where('is_active', '=', 1)
            ->with(['children' => function ($q) {
                $q->where('is_active', '=', 1)->orderBy('name', 'ASC');
            }])
            ->orderBy('name', 'ASC')
            ->get();
        $product->load([
            'categories',
            'tags',
            'variants',
            'variants.attributeValues'
        ]);
        return view(self::PATH_VIEW . __FUNCTION__, compact(['product', 'attributes', 'tags', 'brands', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if (request('product_type') === 'simple') {
            $data = [
                'name' => request('name'),
                'sku' => request('sku'),
                'slug' => Str::slug(request('slug')) ?? $product->slug,
                'price_import' => request('price_import') ?? 0,
                'price' => request('price') ?? 0,
                'price_sale' => request('price_sale') ?? 0,
                'description' => request('description'),
                'short_desc' => request('short_desc'),
                'brand_id' => request('brand_id'),
                'quantity' => request('quantity') ?? 0,
                'is_active' => request('is_active') ?? 0,
                'is_featured' => request('is_featured') ?? 0,
                'is_new' => request('is_new') ?? 0,
                'is_sale' => request('is_sale') ?? 0,
                'is_hot' => request('is_hot') ?? 0,
                'is_home' => request('is_home') ?? 0,
                'is_best_seller' => request('is_best_seller') ?? 0,
            ];

            if ($request->hasFile('image')) {
                $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            }
            $data['image'] ??= $product->image;


            $categories = request('category_id');
            $tags = request('tags');
            $galleries = request('galleries');

            try {
                $product->update($data);

                if ($product->variants->count()) {
                    foreach ($product->variants as $variant) {
                        $variant->attributeValues()->detach();
                    }

                    $product->variants()->delete();
                }

                $product->tags()->sync($tags);

                $product->categories()->sync($categories);

                if (!empty($galleries)) {
                    $product->galleries()->delete();
                    foreach ($galleries as $gallery) {
                        Gallery::query()->create([
                            'product_id' => $product->id,
                            'image' => Storage::put('galleries', $gallery)
                        ]);
                    }
                }

            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->back()->with('error', $exception->getMessage());
            }
        }
        if (request('product_type') === 'variable') {
            $data = [
                'name' => request('name'),
                'sku' => request('sku'),
                'slug' => Str::slug(request('slug')) ?? $product->slug,
                'description' => request('description'),
                'short_desc' => request('short_desc'),
                'brand_id' => request('brand_id'),
                'is_active' => request('is_active') ?? 0,
                'is_featured' => request('is_featured') ?? 0,
                'is_new' => request('is_new') ?? 0,
                'is_sale' => request('is_sale') ?? 0,
                'is_hot' => request('is_hot') ?? 0,
                'is_home' => request('is_home') ?? 0,
                'is_best_seller' => request('is_best_seller') ?? 0,
            ];

            if ($request->hasFile('image')) {
                $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            }
            $data['image'] ??= $product->image;

            $tags = request('tags');

            $categories = request('category_id');

            $galleries = request('galleries');

            $dataVariants = request('product_variants');

            $data['quantity'] ??= 0;
            foreach ($dataVariants as $variant) {
                $data['quantity'] += $variant['quantity'];
            }

            try {
                $product->update($data);

                $product->categories()->sync($categories);

                $product->tags()->sync($tags);

                $variantID = [];

                foreach ($dataVariants as $key => $variant) {

                    if (Variant::query()->where('id', '=', $key)->exists()) {

                        $item = Variant::query()->findOrFail($key);

                        if (isset($variant['image'])) {
                            $variant['image'] = Storage::put(self::PATH_UPLOAD, $variant['image']);
                        }
                        $variant['image'] ??= $item->image;

                        $item->update($variant);

                        $variantID[] = $item->id;

                    } else {
                        $valueIds = explode('-', $key);
                        array_pop($valueIds);
                        $variant['product_id'] = $product->id;
                        $variant['image'] ??= null;
                        $variant['slug'] = Str::slug(preg_replace('/[^A-Za-z0-9\s]/', '-', request('name'))) . '-' . $variant['sku'];
                        if ($variant['image']) {
                            $variant['image'] = Storage::put(self::PATH_UPLOAD, $variant['image']);
                        }
                        $productVariant = Variant::query()->create($variant);
                        $productVariant->attributeValues()->attach($valueIds);

                        $variantID[] = $productVariant->id;

                    }


                }

                $delVariant = $product->variants()->whereNotIn('id', $variantID)->get();

                foreach ($delVariant as $item)
                {
                    $item->attributeValues()->detach();
                    $item->delete();
                }

                $maxPrice = 0;

                $minPrice = [];

                $attributeValueId = [];

                foreach ($product->variants as $variant) {

                    foreach ($variant->attributeValues as $attributeValue) {
                        $attributeValueId[] = $attributeValue->id;
                    }
                    if ($product->is_sale) {
                        $minPrice[] = $variant->price_sale;

                        if (intval($maxPrice) < intval($variant->price_sale)) {
                            $maxPrice = intval($variant->price_sale);
                        }
                    } else {

                        $minPrice[] = $variant->price;

                        if (intval($maxPrice) < intval($variant->price)) {
                            $maxPrice = intval($variant->price);
                        }
                    }

                }
                $product->update([
                    'price' => $maxPrice,
                    'price_sale' => min($minPrice),
                ]);

                $newAttributeValueId = array_unique($attributeValueId);

                $product->attributeValues()->sync($newAttributeValueId);

                $attributeId = [];

                foreach ($product->attributeValues as $item) {
                    $attributeId[] = $item->attribute_id;
                }

                $newAttributeId = array_unique($attributeId);

                $product->attributes()->sync($newAttributeId);


                if (!empty($galleries)) {
                    foreach ($product->galleries as $gallery) {
                        $gallery->delete();
                        if (!empty($gallery->image) && Storage::exists($gallery->image)) {
                            Storage::delete($gallery->image);
                        }
                    }
                    foreach ($galleries as $gallery) {
                        Gallery::query()->create([
                            'product_id' => $product->id,
                            'image' => Storage::put(self::PATH_UPLOAD, $gallery)
                        ]);
                    }
                }
            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->back()->with('error', $exception->getMessage());
            }
        }
        return redirect()->back()->with('success', 'Update Product Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->variants->count()) {
            try {

                $product->tags()->detach();

                $product->categories()->detach();

                $product->attributeValues()->detach();

                $product->attributes()->detach();

                if ($product->galleries->count()) {
                    foreach ($product->galleries as $gallery) {
                        $gallery->delete();
                        Storage::delete($gallery->image);
                    }
                }

                foreach ($product->variants as $variant) {
                    $variant->attributeValues()->detach();
                    $variant->delete();
                    if (!empty($variant->image) && Storage::exists($variant->image)) {
                        Storage::delete($variant->image);
                    }
                }

                $product->delete();

                if (!empty($product->image) && Storage::exists($product->image)) {
                    Storage::delete($product->image);
                }
            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->route('admin.products.index')->with('error', $exception->getMessage());
            }
        } else {
            try {

                $product->tags()->detach();

                $product->categories()->detach();

                if ($product->galleries->count()) {
                    foreach ($product->galleries as $gallery) {
                        $gallery->delete();
                        Storage::delete($gallery->image);
                    }
                }

                $product->delete();

                if (!empty($product->image) && Storage::exists($product->image)) {
                    Storage::delete($product->image);
                }

            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->route('admin.products.index')->with('error', $exception->getMessage());
            }
        }
        return redirect()->route('admin.products.index')->with('success', 'Delete Product Successfully');

    }
}
