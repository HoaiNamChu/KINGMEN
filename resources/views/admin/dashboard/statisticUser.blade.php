@extends('admin.layouts.main')
@section('content')
    <div class="container-fluid">

        <div class="container mt-5">
            <h1 class="mb-4">User Statistics</h1>

            <!-- Thanh tìm kiếm -->
            <form method="GET" action="{{ url('/admin/statistics/user') }}" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by name or username"
                        value="{{ $search }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>

            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Users</h5>
                            <p class="card-text">{{ $totalUsers }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Active Users</h5>
                            <p class="card-text">{{ $activeUsers }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Unverified Emails</h5>
                            <p class="card-text">{{ $unverifiedEmails }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Danh sách người dùng -->
            <h3>Users</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>
                            Total Orders
                            <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'orders_count', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-sort"></i>
                            </a>
                        </th>
                        <th>
                            Total Amount Spent
                            <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'orders_sum_total', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-sort"></i>
                            </a>
                        </th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name ?? 'N/A' }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->orders_count }}</td>
                            <td>{{ number_format($user->orders_sum_total, 2) }} VND</td>
                            <td>{{ $user->is_active ? 'Active' : 'Inactive' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $users->links() }}
            </div>


        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        <div class="mt-5">
            <h3>User Status Breakdown</h3>
            <canvas id="userStatusChart" width="400" height="200"></canvas>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('userStatusChart').getContext('2d');
            const userStatusChart = new Chart(ctx, {
                type: 'pie', // Loại biểu đồ (pie chart)
                data: {
                    labels: {!! json_encode($userStatusChartData['labels']) !!},
                    datasets: [{
                        label: 'User Status',
                        data: {!! json_encode($userStatusChartData['data']) !!},
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.6)', // Màu cho trạng thái Active
                            'rgba(255, 99, 132, 0.6)' // Màu cho trạng thái Inactive
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            enabled: true,
                        }
                    }
                }
            });
        </script>
    </div>
@endsection
