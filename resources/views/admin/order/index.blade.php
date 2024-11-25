@extends('admin.layouts.main')


@section('content')
    <!-- Start Container Fluid -->
    <div class="container-xxl">

        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="card-title mb-2">Payment Refund</h4>
                                <p class="text-muted fw-medium fs-22 mb-0">490</p>
                            </div>
                            <div>
                                <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                    <iconify-icon icon="solar:chat-round-money-broken"
                                                  class="fs-32 text-primary avatar-title"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="card-title mb-2">Order Cancel</h4>
                                <p class="text-muted fw-medium fs-22 mb-0">241</p>
                            </div>
                            <div>
                                <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                    <iconify-icon icon="solar:cart-cross-broken"
                                                  class="fs-32 text-primary avatar-title"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="card-title mb-2">Order Shipped</h4>
                                <p class="text-muted fw-medium fs-22 mb-0">630</p>
                            </div>
                            <div>
                                <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                    <iconify-icon icon="solar:box-broken"
                                                  class="fs-32 text-primary avatar-title"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="card-title mb-2">Order Delivering</h4>
                                <p class="text-muted fw-medium fs-22 mb-0">170</p>
                            </div>
                            <div>
                                <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                    <iconify-icon icon="solar:tram-broken"
                                                  class="fs-32 text-primary avatar-title"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="card-title mb-2">Pending Review</h4>
                                <p class="text-muted fw-medium fs-22 mb-0">210</p>
                            </div>
                            <div>
                                <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                    <iconify-icon icon="solar:clipboard-remove-broken"
                                                  class="fs-32 text-primary avatar-title"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="card-title mb-2">Pending Payment</h4>
                                <p class="text-muted fw-medium fs-22 mb-0">608</p>
                            </div>
                            <div>
                                <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                    <iconify-icon icon="solar:clock-circle-broken"
                                                  class="fs-32 text-primary avatar-title"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="card-title mb-2">Delivered</h4>
                                <p class="text-muted fw-medium fs-22 mb-0">200</p>
                            </div>
                            <div>
                                <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                    <iconify-icon icon="solar:clipboard-check-broken"
                                                  class="fs-32 text-primary avatar-title"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="card-title mb-2">In Progress</h4>
                                <p class="text-muted fw-medium fs-22 mb-0">656</p>
                            </div>
                            <div>
                                <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                    <iconify-icon icon="solar:inbox-line-broken"
                                                  class="fs-32 text-primary avatar-title"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="d-flex card-header justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">All Order List</h4>
                        </div>
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
                                    <th>Created at</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Payment Status</th>
                                    <th>Items</th>
                                    <th>Order Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($orders as $item )
                                    <tr>
                                        <td>
                                            {{ $item->id }}
                                        </td>
                                        <td>{{ date_format($item->created_at, 'd/m/y H:i:s') }}</td>
                                        <td>
                                            <a href="{{ route('admin.users.show', $item->user->id) }}"
                                               class="link-primary fw-medium">{{ $item->user->name }}</a>
                                        </td>
                                        <td> {{ number_format($item->total) }} VND</td>
                                        <td>
                                            @if($item->payment_status)
                                                <span class="badge bg-success text-light  px-2 py-1 fs-13">Paid</span>
                                            @else
                                                <span class="badge bg-light text-dark  px-2 py-1 fs-13">Unpaid</span>
                                            @endif
                                        </td>
                                        <td> {{ $item->orderItems->count() }}</td>
                                        <td><span
                                                class="badge border border-warning text-secondary  px-2 py-1 fs-13">{{ $item->status }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{route('admin.orders.show', $item->id )}}" class="btn btn-light btn-sm">
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
{{--                                <li class="page-item"><a class="page-link"--}}
{{--                                                         href="javascript:void(0);">Previous</a></li>--}}
{{--                                <li class="page-item active"><a class="page-link"--}}
{{--                                                                href="javascript:void(0);">1</a></li>--}}
{{--                                <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>--}}
{{--                                <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>--}}
{{--                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a>--}}
{{--                                </li>--}}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- End Container Fluid -->

@endsection
