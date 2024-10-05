<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.brands.';
    const PATH_UPLOAD = 'brands';

    public function index()
    {
        $brands = Brand::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'name' => request('name'),
            'description' => request('description'),
            'slug' => Str::slug(request('name')),
            'is_active' => request('is_active')
        ];

        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        }
        $data['image'] ??= null;

        try {
            Brand::query()->create($data);
            return redirect()->route('admin.brands.index');
        }catch (\Exception $exception){
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
    public function show(string $id)
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::query()->findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::query()->findOrFail($id);
        $oldImage = $brand->image;
        $data = [
            'name' => request('name'),
            'description' => request('description'),
            'slug' => Str::slug(request('slug')),
            'is_active' => request('is_active')
        ];
        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        }
        $data['image'] ??= $brand->image;
        try {
            $brand->update($data);
            if ($data['image'] != $oldImage && $oldImage && Storage::exists($oldImage)) {
                Storage::delete($oldImage);
            }
            return redirect()->route('admin.brands.edit',$brand);
        }catch (\Exception $exception){
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
    public function destroy(string $id)
    {
        $brand = Brand::query()->findOrFail($id);
        try {
            $brand->delete();
            if ($brand->image && Storage::exists($brand->image)){
                Storage::delete($brand->image);
            }
            return redirect()->route('admin.brands.index');
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->withErrors([$exception->getMessage()]);
        }
    }
}
