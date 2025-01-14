@extends('admin.layouts.main')


@section('content')
    <div class="container-fluid">

        <!-- Start here.... -->
        <div class="row">

            <div class="col-xxl-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-md bg-soft-primary rounded">
                                            <iconify-icon icon="solar:cart-5-bold-duotone"
                                                          class="avatar-title fs-32 text-primary"></iconify-icon>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-6 text-end">
                                        <p class="text-muted mb-0 text-truncate">Total Orders</p>
                                        <h3 class="text-dark mt-1 mb-0">{{ number_format($totalOrders) }}</h3>
                                    </div> <!-- end col -->
                                </div> <!-- end row-->
                            </div> <!-- end card body -->
                            <div class="card-footer py-2 bg-light bg-opacity-50">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href=" {{ route('admin.statistics.orders')}} "
                                       class="text-reset fw-semibold fs-12">View More</a>
                                </div>
                            </div> <!-- end card body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-md bg-soft-primary rounded">
                                            <i class="bx bx-award avatar-title fs-24 text-primary"></i>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-6 text-end">
                                        <p class="text-muted mb-0 text-truncate">Total Accounts</p>
                                        <h3 class="text-dark mt-1 mb-0">{{ $totalUsers }}</h3>
                                    </div> <!-- end col -->
                                </div> <!-- end row-->
                            </div> <!-- end card body -->
                            <div class="card-footer py-2 bg-light bg-opacity-50">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="{{ route('admin.statistics.users')}}" class="text-reset fw-semibold fs-12">View
                                        More</a>
                                </div>
                            </div> <!-- end card body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- end col -->

            {{-- THỐNG KÊ DOANH THU --}}
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Revenue statistics</h4>
                            <div class="d-flex gap-2">
                                <!-- nngày bắt đầu -->
                                <input type="date" id="start-date" class="form-control form-control-sm"/>
                                <!-- nngày kết thúc -->
                                <input type="date" id="end-date" class="form-control form-control-sm"/>
                                <!-- llọc theo tuần -->
                                <button type="button" class="btn btn-sm btn-info" onclick="filterWeek()">Tuần</button>
                                <!-- Theo tháng  -->
                                <button type="button" class="btn btn-sm btn-info" onclick="filterMonth()">Tháng</button>
                                <!-- lọc theo năm -->
                                <button type="button" class="btn btn-sm btn-info" onclick="filterYear()">Năm</button>

                                <button type="button" class="btn btn-sm btn-primary" onclick="filterChart()">Lọc
                                </button>
                            </div>
                        </div><!-- end card-title-->

                        <div dir="ltr">
                            <div id="revenue-chart" class="apex-charts"></div>
                        </div>

                        <div class="mt-3">
                            <h5>Total revenue: <span id="total-revenue"></span> VNĐ</h5>
                        </div>
                    </div> <!-- end card body -->
                </div> <!-- end card -->
            </div> <!-- end col -->

        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="card-title">
                                Top 10 Selling Product
                            </h4>
                        </div>
                    </div>
                    <!-- end card body -->
                    <div class="table-responsive table-centered">
                        <table class="table mb-0">
                            <thead class="bg-light bg-opacity-50">
                            <tr>
                                <th colspan="2">
                                    Product
                                </th>
                                <th>
                                    Brand
                                </th>
                                <th>
                                    Quantity sold
                                </th>
                                <th>
                                    Quantity in stock
                                </th>
                            </tr>
                            </thead>
                            <!-- end thead-->
                            <tbody>
                            @foreach($topSellingProducts as $item)
                                @if($item->order_items_count >0)
                                    <tr>
                                        <td>
                                            <img
                                                src="{{ Storage::url($item->image) }}"
                                                alt="product-1(1)"
                                                class="img-fluid avatar-sm">
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.products.edit', $item->id) }}">{{ $item->name }}</a>
                                        </td>
                                        <td>@if($item->brand == null )
                                                No brand
                                            @else
                                                {{ $item->brand->name }}
                                            @endif
                                        </td>
                                        <td>{{ $item->order_items_sum_product_quantity }}</td>
                                        <td>{{ $item->quantity }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                            <!-- end tbody -->
                        </table>
                        <!-- end table -->
                    </div>
                    <!-- table responsive -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div> <!-- end row -->

    </div>
@endsection

@section('lib-script')
    <!-- Vector Map Js -->
    <script src="{{ asset('theme/admin/assets/vendor/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/vendor/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/vendor/jsvectormap/maps/world.js') }}"></script>

    <!-- Dashboard Js -->
    <script src="{{ asset('theme/admin/assets/js/pages/dashboard.js') }}"></script>
@endsection
