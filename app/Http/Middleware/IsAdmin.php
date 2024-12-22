<?php

namespace App\Http\Middleware;

use App\Events\Admin\AdminLogin;
use App\Events\Admin\StaffPrivateChannel;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user()->load([
            'roles',
            'roles.permissions'
        ]);

        if (!$user->roles->count()){
            return redirect()->route('home')->with('error', 'You are not authorized to access this page.');
        }

//        broadcast(new StaffPrivateChannel('You just login here!', $user->id));

//        broadcast(new AdminLogin($user));

        return $next($request);
    }
}
