<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticUserController extends Controller
{
    //
    public function showStatisticsPage(Request $request)
    {
        $search = $request->input('search');

        // $users = User::when($search, function ($query, $search) {
        //     $query->where('name', 'like', "%$search%")
        //         ->orWhere('username', 'like', "%$search%");
        // })->orderBy('username', 'asc')->paginate(10);
        // // Lấy danh sách người dùng kèm thống kê số đơn hàng và tổng tiền đã mua
        // $userOrderStats = User::select('users.id', 'users.name', 'users.email')
        //     ->withCount('orders')
        //     ->withSum('orders', 'total')
        //     ->get();
        $users = User::when($search, function ($query, $search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('username', 'like', "%$search%");
        })
        ->select('users.id', 'users.name', 'users.email')
        ->withCount('orders')
        ->withSum('orders', 'total')
        ->orderBy(request('sort_by', 'username'), request('sort_order', 'asc'))
        ->paginate(10);

        $totalUsers = User::count();
        $activeUsers = User::where('is_active', 1)->count();
        $inactiveUsers = User::where('is_active', 0)->count();
        // $unverifiedEmails = User::whereNull('email_verified_at')->count();
        $userStatus = User::select('is_active', DB::raw('count(*) as total'))
            ->groupBy('is_active')
            ->get();
        $userStatusChartData = [
            'labels' => $userStatus->pluck('is_active')->map(function ($isActive) {
                return $isActive ? 'Active' : 'Inactive';
            }),
            'data' => $userStatus->pluck('total'),
        ];

        return view('admin.dashboard.statisticUser', compact('totalUsers', 'activeUsers', 'inactiveUsers', 'userStatus', 'search', 'users', 'userStatusChartData'));
    }
}
