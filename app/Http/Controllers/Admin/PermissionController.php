<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
//
public function index()
{
    $permissions = Permission::with('roles')->get();
    return view('admin.permissions.index', compact('permissions'));
}

// Tạo quyền mới
public function create()
{
    return view('admin.permissions.add');
}

public function store(Request $request)
{
    $request->validate(['name' => 'required|unique:permissions']);
    Permission::create($request->all());
    return redirect()->route('admin.permissions.index')->with('success', 'Permission created successfully.');
}

public function edit($id)
{
$permission = Permission::findOrFail($id);
return view('admin.permissions.update', compact('permission'));
}

public function update(request $request, Permission $permission)
{

// Cập nhật role với dữ liệu mới
$permission->update([
    'name' => $request->name,
    'description' => $request->description,
]);

// Chuyển hướng về trang danh sách roles với thông báo thành công
return redirect()->route('admin.permissions.index')->with('success', 'permission đã được cập nhật thành công!');
}

public function destroy($id)
{
    // Tìm permission theo ID và xóa
    $permission = Permission::findOrFail($id);
    $permission->delete();

    // Chuyển hướng với thông báo thành công
    return redirect()->route('admin.permissions.index')->with('success', 'Permission deleted successfully.');
}
}
