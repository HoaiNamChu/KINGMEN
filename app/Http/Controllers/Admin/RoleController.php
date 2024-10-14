<?php

namespace App\Http\Controllers\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\Roles\RoleRequest;
use App\Http\Requests\Admin\Roles\UpdateRoleRequest;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;







class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $roles = Role::all();
        // Trả về view 'roles.index' và truyền dữ liệu roles sang
       return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $permissions = Permission::all();
        return view('admin.roles.add', compact('permissions'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        //
        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_active'=>$request->is_active,
        ]);
        $role->permissions()->attach($request->permissions); // Thêm các quyền đã chọn

        return redirect()->route('admin.roles.index')->with('success', 'Role được tạo thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
        $permissions = Permission::all(); // Lấy tất cả các quyền
        return view('admin.roles.update', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {

        // Cập nhật role với dữ liệu mới
        $role->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_active'=>$request->is_active,
        ]);
         $role->permissions()->sync($request->permissions); // Cập nhật các quyền đã chọn

        // Chuyển hướng về trang danh sách roles với thông báo thành công
        return redirect()->route('admin.roles.index')->with('success', 'Role đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
          // Gỡ role khỏi tất cả người dùng trước khi xóa
          $role->users()->detach();

          // Sau đó xóa role
        $role->delete();

        // Chuyển hướng về trang danh sách roles với thông báo thành công
        return redirect()->route('admin.roles.index')->with('success', 'Role đã được xóa thành công!');
    }
}
