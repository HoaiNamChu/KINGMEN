<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\StoreCategoryRequset;
use App\Http\Requests\Admin\Categories\UpdateCategoryRequset;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.categories.';
    const PATH_UPLOAD = 'categories';

    public function index()
    {
        $categories = Category::query()
            ->whereNull('parent_id')->with(['children' => function ($q) {
            $q->orderBy('name', 'ASC');
        }])
            ->with('products')
            ->latest()
            ->orderBy('name', 'ASC')
            ->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->whereNull('parent_id')->with('children')->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequset $request)
    {
        $data = [
            'name' => request('name'),
            'parent_id' => request('parent_id'),
            'description' => request('description'),
            'is_active' => request('is_active'),
        ];
        $data['slug'] = Str::slug($data['name']);
        if (request()->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, request()->file('image'));
        }
        $data['image'] ??= null;

        try {
            $category = Category::query()->create($data);
            return redirect()->back()->with('success', 'Add Category successfully');
        } catch (\Exception $exception) {
            if ($data['image'] && Storage::exists($data['image'])) {
                Storage::delete($data['image']);
            }
            DB::rollBack();
            return redirect()->back()->withErrors([$exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::query()
            ->whereNull('parent_id')->with(['children' => function ($q) {
                $q->orderBy('name', 'ASC');
            }])
            ->with('products')
            ->orderBy('name', 'ASC')
            ->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequset $request, Category $category)
    {
        $oldImage = $category->image;
        $data = [
            'name' => request('name'),
            'parent_id' => request('parent_id'),
            'description' => request('description'),
            'slug' => Str::slug(request('slug')),
            'is_active' => request('is_active')
        ];
        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        }
        $data['image'] ??= $category->image;
        try {
            $category->update($data);
            if ($data['image'] != $oldImage && $oldImage && Storage::exists($oldImage)) {
                Storage::delete($oldImage);
            }
            return redirect()->route('admin.categories.edit', $category)->with('success', 'Update Category successfully');
        } catch (\Exception $exception) {
            if ($data['image'] != $oldImage && Storage::exists($data['image'])) {
                Storage::delete($data['image']);
            }
            DB::rollBack();
            return redirect()->back()->withErrors([$exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            if ($category->image && Storage::exists($category->image)) {
                Storage::delete($category->image);
            }
            return redirect()->back()->with('success', 'Delete Category successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back();
        }
    }
}
