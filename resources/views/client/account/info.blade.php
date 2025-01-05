@extends('client.account.layout-account')

@section('tab-pane')
    <div id="account-info">
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
                               value="{{ Auth::user()->username }}" readonly/>
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
@endsection
