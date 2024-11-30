@extends('client.layouts.main')

@section('content')
    <!--== Start My Account Area Wrapper ==-->
    <section class="account-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 m-auto">
                    <div class="section-title text-center">
                        <h2 class="title">Login</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="login-form-content">
                        <form action="{{ route('login.submit') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email">Email address <span class="required">*</span></label>
                                        <input id="username" name="email" class="form-control" type="email"
                                               value="{{ old('email') }}">
                                        @if($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="password">Password <span class="required">*</span></label>
                                        <input id="password" name="password" class="form-control" type="password">
                                        @if($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <!-- Hiển thị thông báo lỗi nếu thông tin đăng nhập không đúng -->
                                @if($errors->has('login_error'))
                                    <div class="col-12">
                                        <div class="alert alert-danger">
                                            {{ $errors->first('login_error') }}
                                        </div>
                                    </div>
                                @endif
                                <div class="col-12">
                                    <div class="form-group mb--0">
                                        <div class="form-group mb--0">
                                            <button type="submit" class="btn-login">Login</button>
                                        </div>
                                    </div>
                                    <div class="text-center">Hoặc</div>

                                    <div class="text-center">
                                        <div class="col-md-12">
                                            <a class="btn btn-lg btn-google btn-block btn-outline"
                                               href="{{ route('login-by-google') }}"><img
                                                    src="https://img.icons8.com/color/16/000000/google-logo.png"> Sign
                                                in with GOOGLE</a>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group account-info-group mb--0">
                                    <div class="rememberme-account">
                                        <div class="form-check">
                                            <a class="lost-password" href="/register">Create new account</a>
                                        </div>
                                    </div>
                                    <a class="lost-password" href="/forget-password">Forgot password?</a>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <!--== End My Account Area Wrapper ==-->
@endsection
