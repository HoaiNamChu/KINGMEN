<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brands\StoreBrandRequest;
use App\Http\Requests\Admin\Brands\UpdateBrandRequest;
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
        $userId = 8; // Thay thế bằng ID của người dùng hiện tại, khi có chức năng đăng nhập lấy id từ tài khoản đăng nhập
        $userRoles = DB::table('role_user')
        ->join('roles', 'role_user.role_id', '=', 'roles.id')
        ->where('role_user.user_id', $userId)
        ->pluck('roles.name') // Lấy tên vai trò từ bảng roles
        ->toArray();
        if (in_array('Admin', $userRoles)) {
            # code...
            $brands = Brand::query()->with('products')->latest()->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('brands'));
          }
          return back()->with('error', 'Bạn không có quyền truy cập vào trang này.');
       
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
    public function store(StoreBrandRequest $request)
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
            $brand = Brand::query()->create($data);
            return redirect()->route('admin.brands.edit', $brand)->with('success', 'Created brand successfully');
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
    public function show(Brand $brand)
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
//        $brand = Brand::query()->findOrFail($brand);
        return view(self::PATH_VIEW . __FUNCTION__, compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
//        $brand = Brand::query()->findOrFail($brand);
        $oldImage = $brand->image;
        $data = [
            'name' => request('name'),
            'description' => request('description'),
            'is_active' => request('is_active')
        ];
        if (request('slug')) {
            $data['slug'] = Str::slug(request('slug'));
        }else{
            $data['slug'] = Str::slug(request('name'));
        }
        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        }
        $data['image'] ??= $brand->image;
        try {
            $brand->update($data);
            if ($data['image'] != $oldImage && $oldImage && Storage::exists($oldImage)) {
                Storage::delete($oldImage);
            }
            return redirect()->route('admin.brands.edit',$brand)->with('success', 'Updated brand successfully');
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
    public function destroy(Brand $brand)
    {
//        $brand = Brand::query()->findOrFail($brand);
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
