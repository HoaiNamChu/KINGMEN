@extends('admin.layouts.main')
@section('content')
    <div class="container-xxl">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="d-flex card-header justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">All Order List</h4>
                        </div>
                        <!-- Form lọc theo Status -->
                        <form method="GET" action="{{ route('admin.orders.index') }}">
                            <div class="input-group">
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="">Lọc theo trạng thái</option>
                                    <option
                                        value="Đang chờ xác nhận" {{ request('status') == 'Đang chờ xác nhận' ? 'selected' : '' }}>
                                        Đang chờ xác nhận
                                    </option>
                                    <option
                                        value="Đã xác nhận" {{ request('status') == 'Đã xác nhận' ? 'selected' : '' }}>
                                        Đã xác nhận
                                    </option>
                                    <option value="Đã hủy" {{ request('status') == 'Đã hủy' ? 'selected' : '' }}>Đã hủy
                                    </option>
                                    <option
                                        value="Hoàn thành" {{ request('status') == 'Hoàn thành' ? 'selected' : '' }}>
                                        Hoàn thành
                                    </option>
                                    <option value="Đang giao hàng"
                                        {{ request('status') == 'Đang giao hàng' ? 'selected' : '' }}>Đang giao hàng
                                    </option>
                                    <option value="Hoàn đơn" {{ request('status') == 'Hoàn đơn' ? 'selected' : '' }}>
                                        Hoàn
                                        đơn
                                    </option>
                                    <option value="Không giao được"
                                        {{ request('status') == 'Không giao được' ? 'selected' : '' }}>Không giao được
                                    </option>
                                    <option value="Đơn yêu cầu hoàn trả"
                                        {{ request('status') == 'Đơn yêu cầu hoàn trả' ? 'selected' : '' }}>Đơn yêu cầu
                                        hoàn trả
                                    </option>
                                </select>
                                <button type="submit" class="btn btn-outline-primary">Lọc</button>
                            </div>
                        </form>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-sm btn-outline-light rounded"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                This Month
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="#!" class="dropdown-item">Download</a>
                                <!-- item-->
                                <a href="#!" class="dropdown-item">Export</a>
                                <!-- item-->
                                <a href="#!" class="dropdown-item">Import</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-hover table-centered">
                                <thead class="bg-light-subtle">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Total</th>
                                    <th>Payment Status</th>
                                    <th>Status</th>
                                    <th>Payment Method</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>#
                                            {{ $order->id }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.users.show', $order->user_id) }}" class="link-primary fw-medium">{{ $order->name }}</a>
                                        </td>
                                        <td> {{ $order->phone }}</td>
                                        <td> {{ $order->address }}</td>
                                        <td>{{ number_format($order->total) }} VND</td>
                                        <td>
                                            @if($order->payment_status == 'Đã thanh toán')
                                                <span
                                                    class="badge  bg-success text-light px-2 py-1 fs-13">{{ $order->payment_status }}</span>
                                            @else
                                                <span
                                                    class="badge  bg-danger text-light px-2 py-1 fs-13">{{ $order->payment_status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->status == 'Hoàn thành')
                                                <span class="badge border border-success text-success  px-2 py-1 fs-13">{{ $order->status }}</span>
                                            @elseif($order->status == 'Đang chờ xác nhận' || $order->status == 'Đơn yêu cầu hoàn trả')
                                                <span class="badge border border-warning text-warning  px-2 py-1 fs-13">{{ $order->status }}</span>
                                            @elseif($order->status == 'Đã hủy' || $order->status == 'Hoàn đơn' || $order->status == 'Không giao được')
                                                <span class="badge border border-danger text-danger  px-2 py-1 fs-13">{{ $order->status }}</span>
                                            @elseif($order->status == 'Đã xác nhận' || $order->status == 'Đang giao hàng')
                                                <span class="badge border border-info text-info  px-2 py-1 fs-13">{{ $order->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $order->payment_method }}</td>
                                        <td> {{ $order->created_at }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                                   class="btn btn-light btn-sm">
                                                    <iconify-icon icon="solar:eye-broken"
                                                                  class="align-middle fs-18"></iconify-icon>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                    <div class="card-footer border-top">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end mb-0">
                                {{ $orders->links() }}
                                {{--                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a></li>--}}
                                {{--                                <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>--}}
                                {{--                                <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>--}}
                                {{--                                <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>--}}
                                {{--                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>--}}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
