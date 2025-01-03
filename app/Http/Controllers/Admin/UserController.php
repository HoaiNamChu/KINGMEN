<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\Users\UserRequest;
use App\Http\Requests\Admin\Users\UpdateUserRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
//
// Hiển thị danh sách người dùng
public function index()
{

    $data = User::query()->get();
    if ($data->isEmpty()) {
    return redirect()->route('admin.users.create')->with('info', 'No users found. Please create a user.');
}

return view('admin.users.index', compact('data'));
    
}

// Hiển thị form tạo mới user
public function create()
{
    $roles = Role::all();
    return view('admin.users.add', compact('roles'));
}

    public function store(UserRequest $request)
{

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
        return redirect()->route('admin.users.index')->with('success', 'User đã được tạo thành công!');
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
public function update(UpdateUserRequest $request, User $user)
{

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

    return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
}

// Xóa user
public function destroy(User $user)
{

        // Kiểm tra nếu người dùng có ảnh và ảnh tồn tại trong thư mục
        if ($user->avatar) {
        Storage::delete($user->avatar); // Xóa avatar cũ nếu có
    }
    $user->delete();
    return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
}
}
