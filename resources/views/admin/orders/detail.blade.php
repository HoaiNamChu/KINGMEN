@extends('admin.layouts.main')


@section('content')
    <div class="container-xxl">

        <div class="row">
            <div class="col-xl-9 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                            <div>
                                <h4 class="fw-medium text-dark d-flex align-items-center gap-2">
                                    #{{ $order->id }}
                                    <span
                                        class="badge bg-success-subtle text-success  px-2 py-1 fs-13">{{$order->payment_status}}</span><span
                                        class="border border-warning text-warning fs-13 px-2 py-1 rounded">{{$order->status}}</span>
                                </h4>
                                <p class="mb-0">Order / Order Details / {{ $order->id }}
                                    - {{ $order->created_at}}
                                </p>
                            </div>
                        </div>

                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH') <!-- Để sử dụng phương thức PATCH -->
                            <div class="mt-4">
                                <h4 class="fw-medium text-dark">Status</h4>
                                <br>
                                <select class="form-control" name="status">
                                    <option
                                        value="Đang chờ xác nhận" @selected($order->status == 'Đang chờ xác nhận')>
                                        Đang chờ xác nhận
                                    </option>
                                    <option value="Đã xác nhận" @selected($order->status == 'Đã xác nhận')>Đã
                                        xác nhận
                                    </option>
                                    <option
                                        value="Đang giao hàng" @selected($order->status == 'Đang giao hàng')>
                                        Đang giao hàng
                                    </option>
                                    <option value="Hoàn thành" @selected($order->status == 'Hoàn thành')>Hoàn
                                        thành
                                    </option>
                                    <option value="Đã hủy" @selected($order->status == 'Đã hủy')>Đã hủy</option>
                                    <option value="Hoàn đơn" @selected($order->status == 'Hoàn đơn')>Hoàn đơn
                                    </option>
                                    <option
                                        value="Không giao được" @selected($order->status == 'Không giao được')>
                                        Không giao được
                                    </option>
                                    <option
                                        value="Đơn yêu cầu hoàn trả" @selected($order->status == 'Đơn yêu cầu hoàn trả')>
                                        Đơn yêu cầu hoàn trả
                                    </option>
                                </select>

                                @if(!empty($order->return_reason))
                                    <div class="d-flex justify-content-between mt-3">
                                        <h5 class="">Lý do hoàn trả</h5>
                                    </div>

                                    <div>
                                        <p class="mb-1">{{ $order->return_reason }}</p>
                                    </div>
                                @endif

                            </div>
                            <div
                                class="card-footer d-flex flex-wrap align-items-center justify-content-between bg-light-subtle gap-2">
                                <div>
                                    <button type="submit" class="btn btn-primary">Cập nhật trạng thái đơn
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- Hiển thị thông báo lỗi nếu có -->
                        @error('status')
                        <div class="alert alert-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror

                        <!-- Hiển thị thông báo thành công nếu có -->
                        @if (session('success'))
                            <div class="alert alert-success mt-2">
                                {{ session('success') }}
                            </div>
                        @endif


                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Product</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-hover table-centered">
                                <thead class="bg-light-subtle border-bottom">
                                <tr>
                                    <th>Product Name &amp; Size</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orderItems as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div
                                                    class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                    <img src="{{ Storage::url($item->product->image) }}"
                                                         alt="{{ $item->product_image }}" class="avatar-md">
                                                </div>
                                                <div>
                                                    <a href="#link đến sản phẩm"
                                                       class="text-dark fw-medium fs-15">{{$item->product_name}}</a>
                                                    <p class="text-muted mb-0 mt-1 fs-13">
                                                        <span>Size : </span>M
                                                    </p>
                                                </div>
                                            </div>

                                        </td>
                                        <td>{{$item->product_quantity}}</td>
                                        <td>{{ number_format($item->product_price, 0, ',', '.') }} VND</td>

                                        <td>{{ number_format($item->total_price, 0, ',', '.') }} VND</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Order Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                <tr>
                                    <td class="px-0">
                                        <p class="d-flex mb-0 align-items-center gap-1">
                                            <iconify-icon
                                                icon="solar:clipboard-text-broken"></iconify-icon>
                                            Sub Total :
                                        </p>
                                    </td>
                                    <td class="text-end text-dark fw-medium px-0">
                                        {{ number_format($subtotal, 0, ',', '.') }} VND
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-0">
                                        <p class="d-flex mb-0 align-items-center gap-1">
                                            <iconify-icon
                                                icon="solar:ticket-broken" class="align-middle"></iconify-icon>
                                            Discount
                                            :
                                        </p>
                                    </td>
                                    <td class="text-end text-dark fw-medium px-0">-
                                        {{ number_format($order->discount, 0, ',', '.') }} VND
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-0">
                                        <p class="d-flex mb-0 align-items-center gap-1">
                                            <iconify-icon
                                                icon="solar:kick-scooter-broken"
                                                class="align-middle"></iconify-icon>
                                            Shipping Fee :
                                        </p>
                                    </td>
                                    <td class="text-end text-dark fw-medium px-0">
                                        {{ number_format($order->shipping_fee, 0, ',', '.') }} VND
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between bg-light-subtle">
                        <div>
                            <p class="fw-medium text-dark mb-0">Total Amount</p>
                        </div>
                        <div>
                            <p class="fw-medium text-dark mb-0">{{ number_format($order->total, 0, ',', '.') }}
                                VND</p>
                        </div>

                    </div>
                </div>
                <!-- <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Payment Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="rounded-3 bg-light avatar d-flex align-items-center justify-content-center">
                                <img src="assets/images/card/mastercard.svg" alt="" class="avatar-sm">
                            </div>
                            <div>
                                <p class="mb-1 text-dark fw-medium">Master Card</p>
                                <p class="mb-0 text-dark">xxxx xxxx xxxx 7812</p>
                            </div>
                            <div class="ms-auto">
                                <iconify-icon icon="solar:check-circle-broken" class="fs-22 text-success"></iconify-icon>
                            </div>
                        </div>
                        <p class="text-dark mb-1 fw-medium">Transaction ID : <span class="text-muted fw-normal fs-13">
                                #IDN768139059</span></p>
                        <p class="text-dark mb-0 fw-medium">Card Holder Name : <span class="text-muted fw-normal fs-13">
                                Gaston Lapierre</span></p>

                    </div>
                </div> -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Customer Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-2">
                            <img src="{{ Storage::url($user->avatar) }}" alt="{{$user->avatar}}"
                                 class="avatar rounded-3 border border-light border-3">
                            <div>
                                <p class="mb-1">{{$order->name}}</p>
                                <a href="#!" class="link-primary fw-medium">{{$user->email}}</a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <h5 class="">Contact Number</h5>
                        </div>
                        <p class="mb-1">{{$order->phone}}</p>

                        <div class="d-flex justify-content-between mt-3">
                            <h5 class="">Shipping Address</h5>
                        </div>

                        <div>
                            <p class="mb-1">{{$order->address}}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
