<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Support\Facades\Auth;
class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        // Giả lập người dùng bằng ID (ví dụ ID = 1)
        // Auth::loginUsingId(1);

        // Lấy người dùng hiện tại
        $user = Auth::user();

        // Kiểm tra nếu người dùng không tồn tại
        if (!$user) {
            abort(403, 'Không tìm thấy người dùng!'); // Không có người dùng, trả về lỗi
        }

        // Lấy danh sách quyền từ roles của người dùng
        $userPermissions = $user->roles() // Kiểm tra ở đây
            ->with('permissions')
            ->get()
            ->pluck('permissions.*.name') // Giả sử cột name lưu tên permission
            ->flatten()
            ->unique()
            ->toArray();

        // Kiểm tra xem user có permission yêu cầu không
        if (!in_array($permission, $userPermissions)) {
            // Auth::logout();
            abort(403, 'Không đủ quyền để thực hiện yêu cầu này!'); // Trả về lỗi nếu không có quyền
        }

        return $next($request);
    }
}
