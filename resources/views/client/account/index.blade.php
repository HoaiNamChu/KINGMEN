@extends('client.layouts.main')

@section('content')

    <!--== Start My Account Wrapper ==-->
    <section class="my-account-area">
        <div class="container pt--0 pb--0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="myaccount-page-wrapper">
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <nav>
                                    <div class="myaccount-tab-menu nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="dashboad-tab" data-bs-toggle="tab" data-bs-target="#dashboad" type="button" role="tab" aria-controls="dashboad" aria-selected="true">Dashboard</button>
                                        <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab" aria-controls="orders" aria-selected="false"> Orders</button>
                                        <button class="nav-link" id="download-tab" data-bs-toggle="tab" data-bs-target="#download" type="button" role="tab" aria-controls="download" aria-selected="false">Download</button>
                                        <button class="nav-link" id="payment-method-tab" data-bs-toggle="tab" data-bs-target="#payment-method" type="button" role="tab" aria-controls="payment-method" aria-selected="false">Payment Method</button>
                                        <button class="nav-link" id="address-edit-tab" data-bs-toggle="tab" data-bs-target="#address-edit" type="button" role="tab" aria-controls="address-edit" aria-selected="false">address</button>
                                        <button class="nav-link" id="account-info-tab" data-bs-toggle="tab" data-bs-target="#account-info" type="button" role="tab" aria-controls="account-info" aria-selected="false">Account Details</button>
                                        <button class="nav-link" onclick="window.location.href='/logout'" type="button">Logout</button>
                                    </div>
                                </nav>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="nav-tabContent">
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="tab-pane fade show active" id="dashboad" role="tabpanel" aria-labelledby="dashboad-tab">
                                        <div class="myaccount-content">
                                            <h3>Dashboard</h3>
                                            <div class="welcome">
                                                <p>Hello, <strong>{{$userData->name}}</strong> (If Not <strong>{{$userData->name}} !</strong><a href="/logout" class="logout"> Logout</a>)</p>
                                            </div>
                                            <p>From your account dashboard. you can easily check & view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                        <div class="myaccount-content">
                                            <h3>Orders</h3>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>Order</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if($userData->orders)
                                                        @foreach($userData->orders as $order)
                                                            <tr>
                                                                <td>{{ $order->id }}</td>
                                                                <td>{{ date_format($order->created_at, 'd-m-Y H:i:s') }}</td>
                                                                <td>{{ $order->status }}</td>
                                                                <td>{{ number_format($order->total) }} VND</td>
                                                                <td><a href="shop-cart.html" class="check-btn sqr-btn ">View</a></td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
{{--                                                            {{ $userData->append(\Request::all())->links() }}--}}
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="download" role="tabpanel" aria-labelledby="download-tab">
                                        <div class="myaccount-content">
                                            <h3>Downloads</h3>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Date</th>
                                                        <th>Expire</th>
                                                        <th>Download</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>Haven - Free Real Estate PSD Template</td>
                                                        <td>Aug 22, 2022</td>
                                                        <td>Yes</td>
                                                        <td><a href="#/" class="check-btn sqr-btn"><i class="fa fa-cloud-download"></i> Download File</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>HasTech - Profolio Business Template</td>
                                                        <td>Sep 12, 2022</td>
                                                        <td>Never</td>
                                                        <td><a href="#/" class="check-btn sqr-btn"><i class="fa fa-cloud-download"></i> Download File</a></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="payment-method" role="tabpanel" aria-labelledby="payment-method-tab">
                                        <div class="myaccount-content">
                                            <h3>Payment Method</h3>
                                            <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                                        </div>
                                    </div>

                                    {{-- Update billing address --}}
                                    <div class="tab-pane fade" id="address-edit" role="tabpanel" aria-labelledby="address-edit-tab">
                                        <div class="myaccount-content">
                                            <h3>Billing Address</h3>
                                            @if(Auth::check())
                                                <form action="/update-billing-address" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="name">Name:</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="{{ $userData->name }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="address">Address:</label>
                                                        <input type="text" class="form-control" id="address" name="address" value="{{ $userData->address }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="phone">Mobile:</label>
                                                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $userData->phone }}"><hr>
                                                    </div>

                                                    <button type="submit" class="btn btn-success" style="background-color: #eb3e32; border-color: #eb3e32;">Update</button>
                                                </form>
                                            @else
                                                <p>Bạn cần đăng nhập để xem thông tin tài khoản.</p>
                                            @endif
                                        </div>
                                    </div>
                                    {{--  --}}

                                    {{-- ACCOUNT detail --}}
                                    <div class="tab-pane fade" id="account-info" role="tabpanel" aria-labelledby="account-info-tab">
                                        <div class="myaccount-content">
                                            <h3>Account Details</h3>
                                            <div class="account-details-form">

                                                <form action="#">
                                                    @if(Auth::check()) <!-- Kiểm tra nếu người dùng đã đăng nhập -->
                                                    <div class="single-input-item">
                                                        <label for="display-name" class="required">Display Name</label>
                                                        <input type="text" id="display-name" value="{{ Auth::user()->name }}" readonly /> <!-- Hiển thị tên hiển thị -->
                                                    </div>

                                                    <div class="single-input-item">
                                                        <label for="email" class="required">Email Address</label>
                                                        <input type="email" id="email" value="{{ Auth::user()->email }}" readonly /> <!-- Hiển thị email người dùng -->
                                                    </div>

                                                    @php
                                                        // Kiểm tra người dùng đã đăng nhập bằng Google hay không
                                                        $finduser = Auth::user();
                                                    @endphp

                                                    @if(!empty($finduser->google_id)) <!-- Kiểm tra nếu người dùng đăng nhập bằng Google -->
                                                    <div class="text-center">
                                                        <div class="col-md-12">
                                                            <img src="https://img.icons8.com/color/16/000000/google-logo.png"> Google account
                                                        </div>
                                                    </div>
                                                    @else
                                                        <form action="#" method="POST">
                                                            @csrf
                                                            <fieldset>
                                                                <legend>you forgot your password ?</legend>
                                                            </fieldset>
                                                            <div class="single-input-item">
                                                                <button class="check-btn sqr-btn">Save Changes</button>
                                                            </div>
                                                        </form>
                                                    @endif


                                                    @else
                                                        <p>Bạn cần đăng nhập để xem thông tin tài khoản.</p> <!-- Thông báo nếu chưa đăng nhập -->
                                                    @endif
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== End My Account Wrapper ==-->

@endsection
