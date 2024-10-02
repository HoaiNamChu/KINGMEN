<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //
    // Hiển thị danh sách người dùng
    public function index()
    {
        $data = User::query()->get();
        return view('admin.users.index', compact('data'));
       
    }

    // Hiển thị form tạo mới user
    public function create()
    {
        return view('admin.users.create');
    }

    // Lưu dữ liệu user mới
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // Tạo mới user
        User::create($validatedData);
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    // Hiển thị thông tin một user cụ thể
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    // Hiển thị form chỉnh sửa thông tin user
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Cập nhật thông tin user
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);

        // Cập nhật user
        $user->update($validatedData);
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    // Xóa user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
