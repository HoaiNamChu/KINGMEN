@extends('client.account.layout-account')

@section('tab-pane')
    <div class="tab-pane fade show active" id="dashboad" role="tabpanel"
         aria-labelledby="dashboad-tab">
        <div class="myaccount-content">
            <h3>Dashboard</h3>
            <div class="welcome">
                <p>Hello, <strong>{{$user->username}}</strong> (If Not
                    <strong>{{$user->username}} !</strong><a href="/logout"
                                                         class="logout">
                        Logout</a>)</p>
                <p><strong>{{$user->username}}</strong> (If you are an administrator
                    click here to access the</strong><a href="/admin"
                                                        class="logout"> Admin
                        Page</a> !)</p>
            </div>
            <p>From your account dashboard. you can easily check & view your
                recent orders, manage your shipping and billing addresses and
                edit your password and account details.</p>
        </div>
    </div>
@endsection
