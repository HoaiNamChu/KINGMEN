@extends('client.layouts.main')

@section('content')
    <!--== Start My Account Area Wrapper ==-->
    <section class="account-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 m-auto">
                    <div class="section-title text-center">
                        <h2 class="title">Forgot Password</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="login-form-content">

                        <form action="{{ route('forget.password.post') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email">Email address <span class="required">*</span></label>
                                        <input id="email" name="email" class="form-control" type="email" value="{{ old('email') }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb--0">
                                        <button type="submit" class="btn-login">Send Password Reset Link</button>
                                    </div>
                                </div>
                            </div><br>

                            <!-- Hiển thị thông báo thành công -->
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- Hiển thị thông báo lỗi -->
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== End My Account Area Wrapper ==-->
@endsection
