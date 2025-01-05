@extends('client.account.layout-account')

@section('tab-pane')
    <div id="orders">
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
                    @foreach ($data as $order )
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
                <div class="row">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
