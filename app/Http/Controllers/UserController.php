<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

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
        $roles = Role::all();
        return view('admin.users.add', compact('roles'));
    }

    // Lưu dữ liệu user mới
    public function store(Request $request)
    {
         // Validate dữ liệu đầu vào
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'username' => 'required|string|max:255|unique:users,username',
        //     'email' => 'required|string|email|max:255|unique:users,email',
        //     'password' => 'required|string|min:3',
        //     'phone' => 'required|string|max:15',
        //     'address' => 'required|string|max:255',
        //     'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Avatar là ảnh
        //     'is_active' => 'required',
        //     'role' => 'required|exists:roles,id',
        // ]);

         // Upload avatar nếu có
         $avatarPath = null;
         if ($request->hasFile('avatar')) {
             $avatarPath = $request->file('avatar')->store('avatars', 'public');
         }
          // Tạo user mới
         $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'avatar' => $avatarPath, // Lưu đường dẫn ảnh vào database
            'is_active' => $request->is_active,
        ]);

           // Liên kết user với role
    $user->roles()->attach($request->role); // Sử dụng bảng role_users

          // Chuyển hướng về trang danh sách users với thông báo thành công
          return redirect()->route('users.create')->with('success', 'User đã được tạo thành công!');
    }

    // Hiển thị thông tin một user cụ thể
    public function show(User $user)
    {
        return view('admin.users.detail', compact('user'));
    }

    // Hiển thị form chỉnh sửa thông tin user
    public function edit(User $user)
    {
        $roles = Role::all(); // Lấy tất cả các quyền
        return view('admin.users.update', compact('user', 'roles'));
    }

    // Cập nhật thông tin user
    public function update(Request $request, User $user)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        //     'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        //     'phone' => 'required|string|max:20|unique:users,phone,' . $user->id,
        //     'address' => 'required|string|max:255',
        //     'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'password' => 'nullable|string|min:8|confirmed',
        //     'roles' => 'required|array',
        // ]);

        // Xử lý avatar nếu có upload
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::delete($user->avatar); // Xóa avatar cũ nếu có
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        // Cập nhật thông tin người dùng
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        // Cập nhật quyền (roles)
        $user->roles()->sync($request->roles); // Đồng bộ roles

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Xóa user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
