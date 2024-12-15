@extends('client.layouts.main')

@section('content')
    <div class="page-header-area" data-bg-img="assets/img/photos/bg3.webp"
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
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

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
                                        <a href="{{ route('product.detail', $item->product->slug) }}">
                                            <img src="{{ Storage::url($item->product_image) }}" width="90" height="110"
                                                 alt="Image-HasTech">
                                        </a>
                                    </td>
                                    <td class="product-name">
                                        <h4 class="title"><a href="hien thi chi tiet san pham">
                                                {{$item->product_name}}</a></h4>
                                    </td>
                                    <td class="product-price">
                                        <span class="price">{{ number_format($item->product_price) }}
                                            VND</span>
                                    </td>
                                    <td class="product-quantity">
                                        <span class="price">{{$item->product_quantity}}</span>
                                    </td>
                                    <td class="product-subtotal">
                                        <span
                                            class="price">{{ number_format($item->total_price) }} VND</span>
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
                        <div style="display: flex; gap: 65px;">
                            <form action="{{ route('order.cancel', $order->id) }}" method="POST">
                                @csrf
                                @method('POST') <!-- Đảm bảo form gửi theo phương thức POST -->
                                <button type="submit" class="btn-theme btn-flat">Hủy đơn</button>
                            </form>
                            <a href="{{route('account.index')}}">
                                <button class="btn-theme btn-flat"> Cancel</button>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
