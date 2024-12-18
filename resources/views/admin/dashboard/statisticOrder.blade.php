@extends('admin.layouts.main')
@section('content')
<div class="container-fluid">

    <div class="container-xxl">
        <h4 class="mb-4">Lọc đơn hàng theo khoảng thời gian</h4>

        <!-- Form chọn ngày -->
        <form action="{{ route('admin.orders.filterByDate') }}" method="GET">
            <div class="row mb-4">
                <!-- Ngày bắt đầu -->
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Ngày bắt đầu</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" required value="{{ request('start_date') }}">
                </div>

                <!-- Ngày kết thúc -->
                <div class="col-md-4">
                    <label for="end_date" class="form-label">Ngày kết thúc</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" required value="{{ request('end_date') }}">
                </div>

                <!-- Nút lọc -->
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Lọc</button>
                </div>
            </div>
        </form>

        <!-- Bảng kết quả -->
        @if(isset($orders) && $orders->isNotEmpty())
            <div class="card">
                <div class="card-header">
                    <h5>Kết quả lọc</h5>
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
                            @foreach($orders as $order)
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
@endsection
@endsection
