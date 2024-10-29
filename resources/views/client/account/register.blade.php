@extends('client.layouts.main')

@section('content')

    <!--== Start My Account Area Wrapper ==-->
    <section class="account-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 m-auto">
                    <div class="section-title text-center">
                        <h2 class="title">Register</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="register-form-content">

                        <form action="{{ route('store') }}" method="POST">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="username">Username <span class="required">*</span></label>
                                        <input id="username" class="form-control" type="text" name="username" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email">Email address <span class="required">*</span></label>
                                        <input id="email" class="form-control" type="email" name="email" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="password">Password <span class="required">*</span></label>
                                        <input id="password" class="form-control" type="password" name="password" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb--0">
                                        <button type="submit" class="btn-register">Register</button>
                                    </div>
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
