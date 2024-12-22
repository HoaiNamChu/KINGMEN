@extends('client.layouts.main')

@section('content')

    <main class="main-content">

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
                                            <button class="nav-link active" id="dashboad-tab" data-bs-toggle="tab"
                                                    data-bs-target="#dashboad" type="button" role="tab"
                                                    aria-controls="dashboad" aria-selected="true">Dashboard
                                            </button>
                                            <button class="nav-link" id="orders-tab" data-bs-toggle="tab"
                                                    data-bs-target="#orders" type="button" role="tab"
                                                    aria-controls="orders" aria-selected="false"> Orders
                                            </button>
                                            <button class="nav-link" id="address-edit-tab" data-bs-toggle="tab"
                                                    data-bs-target="#address-edit" type="button" role="tab"
                                                    aria-controls="address-edit" aria-selected="false">address
                                            </button>
                                            <button class="nav-link" id="account-info-tab" data-bs-toggle="tab"
                                                    data-bs-target="#account-info" type="button" role="tab"
                                                    aria-controls="account-info" aria-selected="false">Account
                                                Details
                                            </button>
                                            <button class="nav-link" onclick="window.location.href='/logout'"
                                                    type="button">Logout
                                            </button>
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
                                        @if(session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
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

                                        <div class="tab-pane fade show active" id="dashboad" role="tabpanel"
                                             aria-labelledby="dashboad-tab">
                                            <div class="myaccount-content">
                                                <h3>Dashboard</h3>
                                                <div class="welcome">
                                                    <p>Hello, <strong>{{$user->name}}</strong> (If Not
                                                        <strong>{{$user->name}} !</strong><a href="/logout"
                                                                                             class="logout">
                                                            Logout</a>)</p>
                                                    <p><strong>{{$user->name}}</strong> (If you are an administrator
                                                        click here to access the</strong><a href="/admin"
                                                                                            class="logout"> Admin
                                                            Page</a> !)</p>
                                                </div>
                                                <p>From your account dashboard. you can easily check & view your
                                                    recent orders, manage your shipping and billing addresses and
                                                    edit your password and account details.</p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="orders" role="tabpanel"
                                             aria-labelledby="orders-tab">
                                            <div class="myaccount-content">
                                                <h3>Orders</h3>
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                        <tr>
                                                            <th>Order</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>Payment Status</th>
                                                            <th>Total</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($user->orders as $order )
                                                            <tr>
                                                                <td>{{$order->id}}</td>
                                                                <td>{{$order->created_at}}</td>
                                                                <td>{{$order->status}}</td>
                                                                <td>{{$order->payment_status}}</td>
                                                                <td>{{$order->total}}</td>
                                                                <td><a href="{{route('order.detail',$order->id)}}"
                                                                       class="check-btn sqr-btn ">View</a></td>
                                                            </tr>
                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Update billing address --}}
                                        <div class="tab-pane fade" id="address-edit" role="tabpanel"
                                             aria-labelledby="address-edit-tab">
                                            <div class="myaccount-content">
                                                <h3>Billing Address</h3>
                                                @if(Auth::check())
                                                    <div class="myaccount-table table-responsive text-center">
                                                        <table class="table table-bordered">
                                                            <thead class="thead-light">
                                                            <tr>
                                                                <th>Phone</th>
                                                                <th>Detailed Address</th>
                                                                <th>Ward/Commune</th>
                                                                <th>District</th>
                                                                <th>City</th>
                                                                <th>Default</th>
                                                                <th>act</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($user->addresses as $address)
                                                                <tr>
                                                                    <td>{{ $address->phone }}</td>
                                                                    <td>{{ $address->detailed_address }}</td>
                                                                    <td>{{ $address->ward }}</td>
                                                                    <td>{{ $address->district }}</td>
                                                                    <td>{{ $address->city }}</td>
                                                                    <td>
                                                                        @if($address->is_default)
                                                                            <span
                                                                                class="badge bg-success">Mặc định</span>
                                                                        @else
                                                                            <form
                                                                                action="{{ route('account.set_default', $address->id) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                @method('PATCH')
                                                                                <button style="margin-top: 20px"
                                                                                        type="submit"
                                                                                        class="badge bg-primary">
                                                                                    Click default
                                                                                </button>
                                                                            </form>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <form
                                                                            action="{{ route('account.delete_address', $address->id) }}"
                                                                            method="POST"
                                                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa địa chỉ này?')">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button style="margin-top: 20px"
                                                                                    type="submit"
                                                                                    class="badge bg-danger ">Delete
                                                                            </button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="account-details-form">
                                                        <div class="single-input-item">
                                                            <button type="button" class="check-btn sqr-btn"
                                                                    id="openAddAddressModal">Add address
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <i><strong>Note:</strong> Your default address will be the
                                                        shipping address.</i>
                                                @else
                                                    <p>Bạn cần đăng nhập để xem thông tin tài khoản.</p>
                                                @endif
                                            </div>
                                        </div>
                                        {{--  --}}


                                        {{-- ACCOUNT detail --}}
                                        <div class="tab-pane fade" id="account-info" role="tabpanel"
                                             aria-labelledby="account-info-tab">
                                            <div class="myaccount-content">
                                                <h3>Account Details</h3>
                                                <div class="account-details-form">

                                                    {{--                                                        <form action="#">--}}
                                                    @if(Auth::check())
                                                        <!-- Kiểm tra nếu người dùng đã đăng nhập -->
                                                        <div class="single-input-item">
                                                            <label for="display-name" class="required">Display
                                                                Name</label>
                                                            <input type="text" id="display-name"
                                                                   value="{{ Auth::user()->name }}" readonly/>
                                                            <!-- Hiển thị tên hiển thị -->
                                                        </div>

                                                        <div class="single-input-item">
                                                            <label for="email" class="required">Email
                                                                Address</label>
                                                            <input type="email" id="email"
                                                                   value="{{ Auth::user()->email }}" readonly/>
                                                            <!-- Hiển thị email người dùng -->
                                                        </div>

                                                        @php
                                                            // Kiểm tra người dùng đã đăng nhập bằng Google hay không
                                                            $finduser = Auth::user();
                                                        @endphp

                                                        @if(!empty($finduser->google_id))
                                                            <!-- Kiểm tra nếu người dùng đăng nhập bằng Google -->
                                                            <div class="text-center">
                                                                <div class="col-md-12">
                                                                    <img
                                                                        src="https://img.icons8.com/color/16/000000/google-logo.png">
                                                                    Google account
                                                                </div>
                                                            </div>
                                                        @else
                                                            <fieldset>
                                                                <legend>you forgot your password ? <a
                                                                        class="lost-password"
                                                                        href="/forget-password">Forgot
                                                                        password.</a></legend>
                                                            </fieldset>
                                                        @endif
                                                    @else
                                                        <p>Bạn cần đăng nhập để xem thông tin tài khoản.</p>
                                                        <!-- Thông báo nếu chưa đăng nhập -->
                                                    @endif
                                                    {{--                                                        </form>--}}

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
    </main>


    <!-- Dialog add address -->
    <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addAddressForm" action="{{ route('account.add_address') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAddressModalLabel">ADD ADDRESS</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                   placeholder="Enter phone number" required>
                        </div>
                        <div class="mb-3">
                            <label for="detailed_address" class="form-label">Detailed Address</label>
                            <textarea class="form-control" id="detailed_address" name="detailed_address" rows="3"
                                      placeholder="Enter detailed address for example: Alley, Lane, Street, house number,..."
                                      required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="province-select" class="form-label">City</label>
                            <select id="province-select" class="form-select" name="city" required>
                                <option value="">--Select City--</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="district-select" class="form-label">District</label>
                            <select id="district-select" class="form-select" name="district" disabled required>
                                <option value="">--Select District--</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="ward-select" class="form-label">Ward/Commune</label>
                            <select id="ward-select" class="form-select" name="ward" disabled required>
                                <option value="">--Select Ward/Commune--</option>
                            </select>
                        </div>
                        <div class="mb-3 form-check">
                            <!-- Hidden input để đảm bảo giá trị 'false' được gửi nếu checkbox không được chọn -->
                            <input type="hidden" name="is_default" value="false">
                            <input type="checkbox" class="form-check-input" id="is_default" name="is_default"
                                   value="true">
                            <label class="form-check-label" for="is_default">Set as Default Address</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    {{-- Script lấy api --}}
    <script>
        const API_BASE_URL = "https://provinces.open-api.vn/api/";

        document.addEventListener('DOMContentLoaded', function () {
            getProvinces();
        });

        async function getProvinces() {
            try {
                const response = await fetch(`${API_BASE_URL}p`);
                if (!response.ok) throw new Error("Lỗi khi lấy dữ liệu tỉnh");
                const data = await response.json();
                populateProvinces(data);
            } catch (error) {
                console.error("Có lỗi xảy ra:", error);
            }
        }

        async function getDistrictsByProvinceID(provinceCode) {
            try {
                const response = await fetch(`${API_BASE_URL}p/${provinceCode}?depth=2`);
                if (!response.ok) throw new Error("Lỗi khi lấy dữ liệu huyện");
                const data = await response.json();
                populateDistricts(data.districts);
            } catch (error) {
                console.error("Có lỗi xảy ra:", error);
            }
        }

        async function getWardsByDistrictID(districtCode) {
            try {
                const response = await fetch(`${API_BASE_URL}d/${districtCode}?depth=2`);
                if (!response.ok) throw new Error("Lỗi khi lấy dữ liệu xã");
                const data = await response.json();
                populateWards(data.wards);
            } catch (error) {
                console.error("Có lỗi xảy ra:", error);
            }
        }

        function populateProvinces(provinces) {
            const provinceSelect = document.getElementById('province-select');
            provinceSelect.innerHTML = '<option value="">--Select City--</option>';
            provinces.forEach(province => {
                // Gán data-code để giữ mã tỉnh
                provinceSelect.innerHTML += `<option value="${province.name}" data-code="${province.code}">${province.name}</option>`;
            });

            provinceSelect.addEventListener('change', function () {
                // Lấy mã tỉnh từ data-code
                const provinceCode = this.options[this.selectedIndex].getAttribute('data-code');
                if (provinceCode) {
                    getDistrictsByProvinceID(provinceCode);
                } else {
                    clearDistricts();
                    clearWards();
                }
            });
        }


        function populateDistricts(districts) {
            const districtSelect = document.getElementById('district-select');
            districtSelect.innerHTML = '<option value="">--Chọn huyện--</option>';
            districts.forEach(district => {
                // Gán data-code để giữ mã huyện
                districtSelect.innerHTML += `<option value="${district.name}" data-code="${district.code}">${district.name}</option>`;
            });
            districtSelect.disabled = false;

            districtSelect.addEventListener('change', function () {
                // Lấy mã huyện từ data-code
                const districtCode = this.options[this.selectedIndex].getAttribute('data-code');
                if (districtCode) {
                    getWardsByDistrictID(districtCode);
                } else {
                    clearWards();
                }
            });
        }

        function populateWards(wards) {
            const wardSelect = document.getElementById('ward-select');
            wardSelect.innerHTML = '<option value="">--Chọn xã--</option>';
            wards.forEach(ward => {
                wardSelect.innerHTML += `<option value="${ward.name}">${ward.name}</option>`;
            });
            wardSelect.disabled = false;
        }


        function clearDistricts() {
            const districtSelect = document.getElementById('district-select');
            districtSelect.innerHTML = '<option value="">--Chọn huyện--</option>';
            districtSelect.disabled = true;
            clearWards();
        }

        function clearWards() {
            const wardSelect = document.getElementById('ward-select');
            wardSelect.innerHTML = '<option value="">--Chọn xã--</option>';
            wardSelect.disabled = true;
        }

        // MỞ form add
        document.getElementById('openAddAddressModal').addEventListener('click', function () {
            const modal = new bootstrap.Modal(document.getElementById('addAddressModal'));
            modal.show();
        });

    </script>

@endsection
