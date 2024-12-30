@extends('admin.layouts.main')


@section('content')
    <div class="container-fluid">

        <!-- Start here.... -->
        <div class="row">
            <div class="col-xxl-5">
                <div class="row">
                    <div class="col-12">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>

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
                                        <h3 class="text-dark mt-1 mb-0">13, 647</h3>
                                    </div> <!-- end col -->
                                </div> <!-- end row-->
                            </div> <!-- end card body -->
                            <div class="card-footer py-2 bg-light bg-opacity-50">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <span class="text-success"> <i class="bx bxs-up-arrow fs-12"></i> 2.3%</span>
                                        <span class="text-muted ms-1 fs-12">Last Week</span>
                                    </div>
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
                                        <p class="text-muted mb-0 text-truncate">New Leads</p>
                                        <h3 class="text-dark mt-1 mb-0">9, 526</h3>
                                    </div> <!-- end col -->
                                </div> <!-- end row-->
                            </div> <!-- end card body -->
                            <div class="card-footer py-2 bg-light bg-opacity-50">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <span class="text-success"> <i class="bx bxs-up-arrow fs-12"></i> 8.1%</span>
                                        <span class="text-muted ms-1 fs-12">Last Month</span>
                                    </div>
                                    <a href="{{ route('admin.statistics.users')}}" class="text-reset fw-semibold fs-12">View
                                        More</a>
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
                                            <i class="bx bxs-backpack avatar-title fs-24 text-primary"></i>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-6 text-end">
                                        <p class="text-muted mb-0 text-truncate">Deals</p>
                                        <h3 class="text-dark mt-1 mb-0">976</h3>
                                    </div> <!-- end col -->
                                </div> <!-- end row-->
                            </div> <!-- end card body -->
                            <div class="card-footer py-2 bg-light bg-opacity-50">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <span class="text-danger"> <i class="bx bxs-down-arrow fs-12"></i> 0.3%</span>
                                        <span class="text-muted ms-1 fs-12">Last Month</span>
                                    </div>
                                    <a href="#!" class="text-reset fw-semibold fs-12">View More</a>
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
                                            <i class="bx bx-dollar-circle avatar-title text-primary fs-24"></i>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-6 text-end">
                                        <p class="text-muted mb-0 text-truncate">Booked Revenue</p>
                                        <h3 class="text-dark mt-1 mb-0">$123.6k</h3>
                                    </div> <!-- end col -->
                                </div> <!-- end row-->
                            </div> <!-- end card body -->
                            <div class="card-footer py-2 bg-light bg-opacity-50">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <span class="text-danger"> <i class="bx bxs-down-arrow fs-12"></i> 10.6%</span>
                                        <span class="text-muted ms-1 fs-12">Last Month</span>
                                    </div>
                                    <a href="#!" class="text-reset fw-semibold fs-12">View More</a>
                                </div>
                            </div> <!-- end card body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- end col -->

            {{-- THỐNG KÊ DOANH THU --}}
            <div class="col-xxl-7">
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
                                Recent Orders
                            </h4>

                            <a href="#!" class="btn btn-sm btn-soft-primary">
                                <i class="bx bx-plus me-1"></i>Create Order
                            </a>
                        </div>
                    </div>
                    <!-- end card body -->
                    <div class="table-responsive table-centered">
                        <table class="table mb-0">
                            <thead class="bg-light bg-opacity-50">
                            <tr>
                                <th class="ps-3">
                                    Order ID.
                                </th>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Product
                                </th>
                                <th>
                                    Customer Name
                                </th>
                                <th>
                                    Email ID
                                </th>
                                <th>
                                    Phone No.
                                </th>
                                <th>
                                    Address
                                </th>
                                <th>
                                    Payment Type
                                </th>
                                <th>
                                    Status
                                </th>
                            </tr>
                            </thead>
                            <!-- end thead-->
                            <tbody>
                            <tr>
                                <td class="ps-3">
                                    <a href="order-detail.html">#RB5625</a>
                                </td>
                                <td>29 April 2024</td>
                                <td>
                                    <img src="{{ asset('theme/admin/assets/images/products/product-1(1).png') }}"
                                         alt="product-1(1)"
                                         class="img-fluid avatar-sm">
                                </td>
                                <td>
                                    <a href="#!">Anna M. Hines</a>
                                </td>
                                <td>anna.hines@mail.com</td>
                                <td>(+1)-555-1564-261</td>
                                <td>Burr Ridge/Illinois</td>
                                <td>Credit Card</td>
                                <td>
                                    <i class="bx bxs-circle text-success me-1"></i>Completed
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-3">
                                    <a href="order-detail.html">#RB9652</a>
                                </td>
                                <td>25 April 2024</td>
                                <td>
                                    <img src="{{ asset('theme/admin/assets/images/products/product-4.png') }}"
                                         alt="product-4"
                                         class="img-fluid avatar-sm">
                                </td>
                                <td>
                                    <a href="#!">Judith H. Fritsche</a>
                                </td>
                                <td>judith.fritsche.com</td>
                                <td>(+57)-305-5579-759</td>
                                <td>SULLIVAN/Kentucky</td>
                                <td>Credit Card</td>
                                <td>
                                    <i class="bx bxs-circle text-success me-1"></i>Completed
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-3">
                                    <a href="order-detail.html">#RB5984</a>
                                </td>
                                <td>25 April 2024</td>
                                <td>
                                    <img src="{{ asset('theme/admin/assets/images/products/product-5.png') }}"
                                         alt="product-5"
                                         class="img-fluid avatar-sm">
                                </td>
                                <td>
                                    <a href="#!">Peter T. Smith</a>
                                </td>
                                <td>peter.smith@mail.com</td>
                                <td>(+33)-655-5187-93</td>
                                <td>Yreka/California</td>
                                <td>Pay Pal</td>
                                <td>
                                    <i class="bx bxs-circle text-success me-1"></i>Completed
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-3">
                                    <a href="order-detail.html">#RB3625</a>
                                </td>
                                <td>21 April 2024</td>
                                <td>
                                    <img src="{{ asset('theme/admin/assets/images/products/product-6.png') }}"
                                         alt="product-6"
                                         class="img-fluid avatar-sm">
                                </td>
                                <td>
                                    <a href="#!">Emmanuel J. Delcid</a>
                                </td>
                                <td>
                                    emmanuel.delicid@mail.com
                                </td>
                                <td>(+30)-693-5553-637</td>
                                <td>Atlanta/Georgia</td>
                                <td>Pay Pal</td>
                                <td>
                                    <i class="bx bxs-circle text-primary me-1"></i>Processing
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-3">
                                    <a href="order-detail.html">#RB8652</a>
                                </td>
                                <td>18 April 2024</td>
                                <td>
                                    <img src="{{ asset('theme/admin/assets/images/products/product-1(2).png') }}"
                                         alt="product-1(2)"
                                         class="img-fluid avatar-sm">
                                </td>
                                <td>
                                    <a href="#!">William J. Cook</a>
                                </td>
                                <td>william.cook@mail.com</td>
                                <td>(+91)-855-5446-150</td>
                                <td>Rosenberg/Texas</td>
                                <td>Credit Card</td>
                                <td>
                                    <i class="bx bxs-circle text-primary me-1"></i>Processing
                                </td>
                            </tr>
                            </tbody>
                            <!-- end tbody -->
                        </table>
                        <!-- end table -->
                    </div>
                    <!-- table responsive -->

                    <div class="card-footer border-top">
                        <div class="row g-3">
                            <div class="col-sm">
                                <div class="text-muted">
                                    Showing
                                    <span class="fw-semibold">5</span>
                                    of
                                    <span class="fw-semibold">90,521</span>
                                    orders
                                </div>
                            </div>

                            <div class="col-sm-auto">
                                <ul class="pagination m-0">
                                    <li class="page-item">
                                        <a href="#" class="page-link"><i class="bx bx-left-arrow-alt"></i></a>
                                    </li>
                                    <li class="page-item active">
                                        <a href="#" class="page-link">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link"><i class="bx bx-right-arrow-alt"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
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
