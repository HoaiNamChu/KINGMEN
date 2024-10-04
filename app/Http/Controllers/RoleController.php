<?php

namespace App\Http\Controllers;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // Lấy tất cả các roles từ DB
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
        return view('admin.roles.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Role::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->route('roles.index')->with('success', 'Role được tạo thành công!');
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
        return view('admin.roles.update', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            // 'is_active' => 'required|boolean', chua hieu is_active
        ]);

        // Cập nhật role với dữ liệu mới
        $role->update([
            'name' => $request->name,
            'description' => $request->description,
            // 'is_active' => $request->is_active,
        ]);

        // Chuyển hướng về trang danh sách roles với thông báo thành công
        return redirect()->route('roles.index')->with('success', 'Role đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
        $role->delete();

        // Chuyển hướng về trang danh sách roles với thông báo thành công
        return redirect()->route('roles.index')->with('success', 'Role đã được xóa thành công!');
    }
}
