<?php

namespace App\Http\Controllers\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\Roles\RoleRequest;
use App\Http\Controllers\Controller;




class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $userId = 5; // Thay thế bằng ID của người dùng hiện tại, khi có chức năng đăng nhập lấy id từ tài khoản đăng nhập
        $userRoles = DB::table('role_user')->where('user_id', $userId)->pluck('role_id')->toArray();

       

       
        if (in_array(1, $userRoles)) {
            # code...
             // Lấy tất cả các roles từ DB
            $roles = Role::all();
             // Trả về view 'roles.index' và truyền dữ liệu roles sang
            return view('admin.roles.index', compact('roles','userRoles'));
          }
        //   trỏ lại vào trang trước đó với thông báo lỗi
          return back()->with('error', 'Bạn không có quyền truy cập vào trang này.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // id= 5 là admin, id= 6 là client
        $userId = 5; // Thay thế bằng ID của người dùng hiện tại, khi có chức năng đăng nhập lấy id từ tài khoản đăng nhập
        $userRoles = DB::table('role_user')->where('user_id', $userId)->pluck('role_id')->toArray();
      if (in_array(1, $userRoles)) {
        # code...
        return view('admin.roles.add');
      }
    //   trỏ lại vào trang trước đó với thông báo lỗi
      return back()->with('error', 'Bạn không có quyền truy cập vào trang này.');
        
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        //
        Role::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_active'=>$request->is_active,
        ]);
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
        return view('admin.roles.update', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {

        // Cập nhật role với dữ liệu mới
        $role->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_active'=>$request->is_active,
        ]);

        // Chuyển hướng về trang danh sách roles với thông báo thành công
        return redirect()->route('admin.roles.index')->with('success', 'Role đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
        $role->delete();

        // Chuyển hướng về trang danh sách roles với thông báo thành công
        return redirect()->route('admin.roles.index')->with('success', 'Role đã được xóa thành công!');
    }
}
