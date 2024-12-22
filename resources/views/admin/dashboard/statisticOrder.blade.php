@extends('admin.layouts.main')
@section('content')
    <div class="container-fluid">

        <div class="container-xxl">
            <h4 class="mb-4">Thống kê đơn hàng</h4>

            <!-- Thống kê tổng quan -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Tổng số đơn hàng</h5>
                            <p class="card-text">{{ $statistics['totalOrders'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Hoàn thành</h5>
                            <p class="card-text">{{ $statistics['completedOrders'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Đã hủy</h5>
                            <p class="card-text">{{ $statistics['cancelledOrders'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Đang giao hàng</h5>
                            <p class="card-text">{{ $statistics['pendingOrders'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="card">
                <div class="card-header">
                    <h5>Thống kê doanh thu</h5>
                </div>
                <div class="card-body">
                    <p>
                        <strong>Doanh thu hiện tại:</strong>
                        {{ number_format($currentRevenue, 0, ',', '.') }} VND
                    </p>
                    <p>
                        <strong>Doanh thu dự kiến:</strong>
                        {{ number_format($expectedRevenue, 0, ',', '.') }} VND
                    </p>
                </div>
            </div> --}}

            <div class="card">
                <div class="card-header">
                    <h5>Thống kê doanh thu</h5>
                </div>
                <div class="aa" style="display: -webkit-inline-box;">
                    <div class="card-body ">
                        <canvas id="revenueChart" style="height: 300px;"></canvas>
                    </div>
                    <div class="card-body ">
                        <canvas id="thongke2" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Form lọc theo ngày -->
            <form action="{{ route('admin.statistics.orders') }}" method="GET">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="start_date" class="form-label">Ngày bắt đầu</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" required
                            value="{{ $startDate }}">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label">Ngày kết thúc</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" required
                            value="{{ $endDate }}">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Lọc</button>
                    </div>
                </div>
            </form>

            <!-- Kết quả lọc -->
            @if ($orders->isNotEmpty())
                <div class="card">
                    <div class="card-header">
                        <h5>Kết quả lọc đơn hàng</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Tên khách hàng</th>
                                    <th>Ngày tạo</th>
                                    <th>Trạng thái</th>
                                    <th>Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <p class="text-center">Không tìm thấy đơn hàng nào trong khoảng thời gian này.</p>
            @endif
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Lấy dữ liệu từ server-side
        const currentRevenue = {{ $currentRevenue }};
        const expectedRevenue = {{ $expectedRevenue }};

        const completedOrders = {{ $statistics['completedOrders'] }};
        const pendingOrders = {{ $statistics['pendingOrders'] }};
        const cancelledOrders = {{ $statistics['cancelledOrders'] }};

        // Cấu hình dữ liệu cho biểu đồ
        const data = {
            labels: ['Doanh thu hiện tại', 'Doanh thu dự kiến'],
            datasets: [{
                data: [currentRevenue, expectedRevenue],
                backgroundColor: ['#4CAF50', '#FF9800'], // Màu sắc cho từng phần
                hoverBackgroundColor: ['#66BB6A', '#FFB74D'], // Màu khi hover
            }]
        };
        const data2 = {
            labels: ['Hoàn thành', 'Đang giao hàng', 'Đã hủy'],
            datasets: [{
                data: [completedOrders, pendingOrders, cancelledOrders],
                backgroundColor: ['#4CAF50', '#2196F3', '#F44336'],
            }]
        };


        // Cấu hình biểu đồ
        const config = {
            type: 'pie', // Biểu đồ tròn
            data: data,
            options: {
                responsive: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                let value = context.raw || 0;
                                return `${label}: ${value.toLocaleString()} VND`;
                            }
                        }
                    }
                }
            }
        };
        const config2 = {
            type: 'pie', // Biểu đồ tròn
            data: data2,
            options: {
                responsive: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                let value = context.raw || 0;
                                return `${label}: ${value.toLocaleString()} VND`;
                            }
                        }
                    }
                }
            }
        };

        // Render biểu đồ
        const revenueChart = new Chart(
            document.getElementById('revenueChart'),
            config
        );
        const thongke2 = new Chart(
            document.getElementById('thongke2'),
            config2
        );
    </script>
@endsection
