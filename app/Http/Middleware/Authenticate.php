<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
         // Lấy người dùng có id = 1 (giả sử là admin)
    $adminUser = \App\Models\User::find(2); 

    // Kiểm tra xem người dùng có tồn tại không
    if ($adminUser) {
        \Illuminate\Support\Facades\Auth::login($adminUser);  // Fake đăng nhập người dùng
    }

        // return $request->expectsJson() ? null : route('login');
    }
}
