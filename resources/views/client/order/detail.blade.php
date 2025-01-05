@extends('client.layouts.main')

@section('content')
    <div class="page-header-area" data-bg-img="{{ asset('theme/client/assets/img/photos/bg3.webp') }}"
         style="background-image: url(&quot;assets/img/photos/bg3.webp&quot;);">
        <div class="container pt--0 pb--0">
            <div class="row">
                <div class="col-12">
                    <div class="page-header-content">
                        <h2 class="title aos-init aos-animate" data-aos="fade-down" data-aos-duration="1000">Shopping
                            Cart
                        </h2>
                        <nav class="breadcrumb-area aos-init aos-animate" data-aos="fade-down" data-aos-duration="1200">
                            <ul class="breadcrumb">
                                <li><a href="{{route('account.index')}}">Orders</a></li>
                                <li class="breadcrumb-sep">//</li>

                                <li>My Order</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="shopping-cart-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart-form table-responsive">

                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th class="product-remove">&nbsp;</th>
                                <th class="product-thumb">&nbsp;</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-subtotal">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->orderItems as $item)
                                <tr class="cart-product-item">
                                    <td class="product-remove">
                                    </td>
                                    <td class="product-thumb">

                                        <img src="{{ Storage::url($item->product_image) }}" width="90" height="110"
                                             alt="Image-HasTech">

                                    </td>
                                    <td class="product-name">
                                        <h4 class="title">
                                            {{$item->product_name}}
                                        </h4>
                                    </td>
                                    <td class="product-price">
                                        <span class="price">{{ number_format($item->product_price) }}
                                            VND</span>
                                    </td>
                                    <td class="product-quantity">
                                        <span class="price">{{$item->product_quantity}}</span>
                                    </td>
                                    <td class="product-subtotal">
                                        <span class="price">{{ number_format($item->total_price) }} VND</span>
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row row-gutter-50">

                <div class="col-md-6 col-lg-4">
                    <div id="CategoriesAccordion" class="shipping-form-calculate">
                        <div class="section-title-cart">
                            <h5 class="title">Address Information</h5>
                        </div>
                        <span data-bs-toggle="collapse" data-bs-target="#CategoriesTwo" aria-expanded="true"
                              role="button">Your shipping address</span>
                        <div id="CategoriesTwo" class="collapse show" data-bs-parent="#CategoriesAccordion">
                            <div class="row row-gutter-50">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="stateCounty" class="visually-hidden"></label>
                                        <input type="text" id="stateCounty" class="form-control" disabled
                                               value="{{$order->address}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="shipping-form-coupon">
                        <div class="section-title-cart">
                            <h5 class="title">Coupon Code</h5>
                            <div class="desc">
                                <p>Amount Saved</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="couponCode" class="visually-hidden">Coupon Code</label>
                                    <input type="text" id="couponCode" class="form-control" disabled
                                           value="{{$order->discount}}">
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-md-12 col-lg-4">
                    <div class="shipping-form-cart-totals">
                        <div class="section-title-cart">
                            <h5 class="title">Order totals</h5>
                        </div>
                        <div class="cart-total-table">
                            <table class="table">
                                <tbody>
                                <tr class="cart-subtotal">
                                    <td>
                                        <p class="value">Shipping fee:</p>
                                    </td>
                                    <td>
                                        <p class="price">{{ number_format($order->shipping_fee) }}VND</p>
                                    </td>
                                </tr>
                                <tr class="shipping">
                                    <td>
                                        <p class="value">Payment</p>
                                    </td>
                                    <td class="price"> {{$order->payment_method}}</td>
                                </tr>
                                <tr class="shipping">
                                    <td>
                                        <p class="value">Payment Status</p>
                                    </td>
                                    <td class="price"> {{$order->payment_status}}</td>
                                </tr>
                                <tr class="shipping">
                                    <td>
                                        <p class="value">Status</p>
                                    </td>
                                    <td class="price"> {{$order->status}}</td>
                                </tr>
                                @if(!empty($order->return_reason))
                                    <tr class="shipping">
                                        <td>
                                            <p class="value">Lý do hoàn đơn</p>
                                        </td>
                                        <td class="price">{{ $order->return_reason }}</td>
                                    </tr>
                                @endif
                                <tr class="order-total">
                                    <td>
                                        <p class="value">Total</p>
                                    </td>
                                    <td>
                                        <p class="price">{{ number_format($order->total) }} VND</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div style="display: flex; gap: 5px;">
                            <!-- Nút hủy đơn hàng nếu status = 'Chờ xác nhận' -->
                            @if($order->status === 'Đang chờ xác nhận')
                                <form action="{{ route('order.cancel', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-theme btn-flat">Hủy đơn</button>
                                </form>
                            @endif

                            <!-- Nút đã nhận được hàng nếu status không phải là 'Chờ xác nhận', 'Hoàn trả', hoặc 'Đã hủy' -->
                            @if(!in_array($order->status, ['Đang chờ xác nhận', 'Hoàn đơn', 'Đã hủy', 'Hoàn thành', 'Đơn yêu cầu hoàn trả', 'Không giao được']))
                                <form action="{{ route('order.access', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-theme btn-flat">Đã nhận được hàng</button>
                                </form>
                            @endif

                            @if($order->status === 'Đơn yêu cầu hoàn trả')
                                <form action="{{ route('order.access', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-theme btn-flat">Hủy yêu cầu hoàn trả đơn</button>
                                </form>

                            @endif

                            <!-- Nút hoàn trả nếu status = 'Hoàn thành' -->
                            @if($order->status === 'Hoàn thành')

                                <button class="btn-theme btn-flat" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">Hoàn trả đơn
                                </button>
                                <!-- Form ẩn, sẽ hiển thị khi bấm nút -->

                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Lý do hoàn trả</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <form id="returnForm" action="{{ route('order.return', $order->id) }}"
                                                  method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <textarea id="reason" name="reason" class="form-control"
                                                                  rows="4"></textarea>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Gửi yêu cầu</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            @endif
                            <a href="{{route('account.orders')}}">
                                <button class="btn-theme btn-flat"> Cancel</button>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        let form = document.getElementById('returnForm');

        form.addEventListener('submit', (e) => {
            e.preventDefault();

            let reason = document.getElementById('reason').value;

            axios.post({{ route('order.return', $order->id) }},{
                reason: reason
            }).then((response) => {
                console.log(response)
            }).catch((errors) => {
                console.log(errors)
            })

        });
    </script>
@endsection
