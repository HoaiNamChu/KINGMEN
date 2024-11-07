@extends('client.layouts.main')


@section('content')
    <!--== Start Page Header Area Wrapper ==-->
    <div class="page-header-area" data-bg-img="assets/img/photos/bg3.webp">
        <div class="container pt--0 pb--0">
            <div class="row">
                <div class="col-12">
                    <div class="page-header-content">
                        <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Checkout</h2>
                        <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
                            <ul class="breadcrumb">
                                <li><a href="index.html">Home</a></li>
                                <li class="breadcrumb-sep">//</li>
                                <li>Checkout</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--== End Page Header Area Wrapper ==-->

    <!--== Start Shopping Checkout Area Wrapper ==-->
    <section class="shopping-checkout-wrap">
        <div class="container">


            <form action="{{ route('order') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="checkout-page-coupon-wrap">
                            <!--== Start Checkout Coupon Accordion ==-->
                            <div class="coupon-accordion" id="CouponAccordion">
                                <div class="card">
                                    <h3>
                                        <i class="fa fa-info-circle"></i>
                                        Have a Coupon?
                                        <a href="#/" data-bs-toggle="collapse" data-bs-target="#couponaccordion">Click
                                            here to enter your code</a>
                                    </h3>
                                    <div id="couponaccordion" class="collapse" data-bs-parent="#CouponAccordion">
                                        <div class="card-body">
                                            <div class="apply-coupon-wrap mb-60">
                                                <p>If you have a coupon code, please apply it below.</p>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" type="text"
                                                                   placeholder="Coupon code">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button class="btn-coupon">Apply coupon</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--== End Checkout Coupon Accordion ==-->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <!--== Start Billing Accordion ==-->
                        <div class="checkout-billing-details-wrap">
                            <h2 class="title">Billing details</h2>
                            <div class="billing-form-wrap">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Name <abbr class="required"
                                                                         title="required">*</abbr></label>
                                            <input id="name" value="{{ Auth::user()->name }}" name="name" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="phone"> Phone <abbr class="required"
                                                                            title="required">*</abbr></label>
                                            <input id="phone" value="{{ Auth::user()->phone }}" name="phone" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="city">Province <abbr class="required"
                                                                             title="required">*</abbr></label>
                                            <select id="city" name="province" class="form-control">
                                                <option value="0">Choose your province</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="district">District <abbr class="required"
                                                                                 title="required">*</abbr></label>
                                            <select id="district" name="district" class="form-control">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ward">Ward <abbr class="required"
                                                                         title="required">*</abbr></label>
                                            <select id="ward" name="ward" class="form-control">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="street-address">Street address <abbr
                                                    class="required" title="required">*</abbr></label>
                                            <input id="street-address" name="house_number" type="text"
                                                   class="form-control"
                                                   placeholder="House number and street name">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb--0">
                                            <label for="order-notes">Order notes (optional)</label>
                                            <textarea id="order-notes" name="note" class="form-control"
                                                      placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--== End Billing Accordion ==-->
                    </div>
                    <div class="col-lg-6">
                        <!--== Start Order Details Accordion ==-->
                        <div class="checkout-order-details-wrap">
                            <div class="order-details-table-wrap table-responsive">
                                <h2 class="title mb-25">Your order</h2>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-body">
                                    @php
                                        $cartTotal = 0;
                                    @endphp
                                    @foreach($cart->cartItems as $item)
                                        <tr class="cart-item">
                                            <td class="product-name">{{ $item->product->name }}<span
                                                    class="product-quantity"> × {{ $item->quantity }}</span>
                                            </td>
                                            @if($item->variant_id)
                                                @if ($item->product->is_sale && $item->variant->price_sale > 0)
                                                    @php
                                                        $cartTotal += intval($item->variant->price_sale) * $item->quantity;
                                                    @endphp
                                                    <td
                                                        class="product-total">{{ number_format(intval($item->variant->price_sale) * $item->quantity) }}
                                                        VND VND
                                                    </td>
                                                @else
                                                    @php
                                                        $cartTotal += intval($item->variant->price) * $item->quantity;
                                                    @endphp
                                                    <td
                                                        class="product-total">{{ number_format(intval($item->variant->price) * $item->quantity) }}
                                                        VND VND
                                                    </td>
                                                @endif
                                            @else
                                                @if ($item->product->is_sale && $item->product->price_sale > 0)
                                                    @php
                                                        $cartTotal += intval($item->product->price_sale) * $item->quantity;
                                                    @endphp
                                                    <td
                                                        class="product-total">{{ number_format(intval($item->product->price_sale) * $item->quantity) }}
                                                        VND VND
                                                    </td>
                                                @else
                                                    @php
                                                        $cartTotal += intval($item->product->price) * $item->quantity;
                                                    @endphp
                                                    <td
                                                        class="product-total">{{ number_format(intval($item->product->price) * $item->quantity) }}
                                                        VND VND
                                                    </td>
                                                @endif
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot class="table-foot">
                                    <tr class="cart-subtotal">
                                        <th>Subtotal</th>
                                        <td>{{ number_format($cartTotal) }} VND</td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>Shipping</th>
                                        <td id="shipping-fee"></td>
                                        <input type="hidden" id="shipping_fee" name="shipping_fee">
                                    </tr>
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td id="order-total"></td>
                                        <input type="hidden" id="order_total" name="order_total">
                                    </tr>
                                    </tfoot>
                                </table>
                                <div class="shop-payment-method">
                                    <div id="PaymentMethodAccordion">
                                        <div class="card">
                                            <div class="card-header" id="check_payments3">
                                                <input type="radio" name="payment_method" id="cash_payment"
                                                       value="cash_payment" checked>
                                                <label data-bs-toggle="collapse" for="cash_payment"
                                                       data-bs-target="#cash-payment">Cash on delivery</label>

                                            </div>
                                            <div id="cash-payment" class="collapse" aria-labelledby="check_payments3"
                                                 data-bs-parent="#PaymentMethodAccordion">
                                                <div class="card-body">
                                                    <p>Pay with cash upon delivery.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="vnpay-payment">
                                                <input type="radio" name="payment_method" id="vnpay_payment"
                                                       value="vnpay_payment">
                                                <label data-bs-toggle="collapse" for="vnpay_payment"
                                                       data-bs-target="#vnpay">VNPAY Payment</label>
                                            </div>
                                            <div id="vnpay" class="collapse" aria-labelledby="vnpay-payment"
                                                 data-bs-parent="#PaymentMethodAccordion">
                                                <div class="card-body">
                                                    <p>Pay with VNPAY</p>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                    <div class="card">--}}
                                        {{--                                        <div class="card-header" id="check_payments4">--}}
                                        {{--                                            <h5 class="title" data-bs-toggle="collapse" data-bs-target="#itemFour"--}}
                                        {{--                                                aria-controls="itemTwo" aria-expanded="false">VNPAY <img src="assets/img/photos/paypal2.webp" width="40"--}}
                                        {{--                                                              height="26" alt="Image-HasTech"></h5>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div id="itemFour" class="collapse" aria-labelledby="check_payments4"--}}
                                        {{--                                             data-bs-parent="#PaymentMethodAccordion">--}}
                                        {{--                                            <div class="card-body">--}}
                                        {{--                                                <p>Pay via PayPal; you can pay with your credit card if you don’t--}}
                                        {{--                                                    have a PayPal account.</p>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                    </div>
                                    <p class="p-text">Your personal data will be used to process your order, support
                                        your experience throughout this website, and for other purposes described in our
                                        <a href="#/">privacy policy.</a></p>
                                    <div class="agree-policy">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" id="privacy"
                                                   class="custom-control-input visually-hidden">
                                            <label for="privacy" class="custom-control-label">I have read and agree to
                                                the website terms and conditions <span class="required">*</span></label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn-theme col-lg-12">Place order</button>
                                </div>
                            </div>
                        </div>
                        <!--== End Order Details Accordion ==-->
                    </div>
                </div>
            </form>

        </div>
    </section>
    <!--== End Shopping Checkout Area Wrapper ==-->
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            var orderTotal = {{$cartTotal}}
            $('#order-total').text(orderTotal.toLocaleString('en-US', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 2
            }) + ' VND');

            $('#order_total').val(orderTotal);

            $.ajax({
                url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/province',
                type: 'GET',
                dataType: "json",
                headers: {
                    'token': 'f3dc65c5-96db-11ef-97be-1ef9613dbf99'
                },
                success: function (data_city) {
                    $.each(data_city.data, function (key_tinh, val_tinh) {
                        $("#city").append('<option value="' + val_tinh.ProvinceName + '" id="' + val_tinh.ProvinceID + '">' + val_tinh.ProvinceName + '</option>');
                    });
                    $("#city").change(function (e) {
                        var idCity = $("#city option:selected").attr('id');
                        //Lấy quận huyện
                        $.ajax({
                            url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/district',
                            type: 'GET',
                            dataType: "json",
                            data: {
                                'province_id': idCity
                            },
                            headers: {
                                'token': 'f3dc65c5-96db-11ef-97be-1ef9613dbf99'
                            },
                            success: function (data_district) {
                                $("#district").html('<option value="0">District</option>');
                                $("#ward").html('<option value="0">Ward</option>');
                                $.each(data_district.data, function (key_quan, val_quan) {
                                    $("#district").append('<option value="' + val_quan.DistrictName + '" id="' + val_quan.DistrictID + '">' + val_quan.DistrictName + '</option>');
                                });
                                //Lấy phường xã
                                $("#district").change(function (e) {
                                    var idDistrict = $("#district option:selected").attr('id');
                                    $.ajax({
                                        url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/ward',
                                        type: 'GET',
                                        dataType: "json",
                                        data: {
                                            'district_id': idDistrict
                                        },
                                        headers: {
                                            'token': 'f3dc65c5-96db-11ef-97be-1ef9613dbf99'
                                        },
                                        success: function (data_ward) {
                                            $("#ward").html('<option value="0">Ward</option>');
                                            $.each(data_ward.data, function (key_phuong, val_phuong) {
                                                $("#ward").append('<option value="' + val_phuong.WardName + '" id="' + val_phuong.WardCode + '">' + val_phuong.WardName + '</option>');
                                            });
                                            $("#ward").change(function (e) {
                                                var idWard = $("#ward option:selected").attr('id');
                                                $.ajax({
                                                    url: 'https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee',
                                                    type: 'GET',
                                                    dataType: "json",
                                                    data: {
                                                        "service_id": 53321,
                                                        "insurance_value": {{ $cartTotal }},
                                                        "coupon": null,
                                                        "from_district_id": 1805,
                                                        "to_district_id": idDistrict,
                                                        "to_ward_code": idWard,
                                                        "height": 1,
                                                        "length": 60,
                                                        "weight": 1,
                                                        "width": 30
                                                    },
                                                    headers: {
                                                        'token': 'f3dc65c5-96db-11ef-97be-1ef9613dbf99',
                                                        'shop_id': '5424556'
                                                    },
                                                    success: function (data) {
                                                        var total = data.data.total;

                                                        var orderTotal1 = Number(orderTotal) + Number(total);

                                                        $('#shipping-fee').text(total.toLocaleString('en-US', {
                                                            minimumFractionDigits: 0,
                                                            maximumFractionDigits: 2
                                                        }) + ' VND');

                                                        $('#shipping_fee').val(total);

                                                        $('#order-total').text(orderTotal1.toLocaleString('en-US', {
                                                            minimumFractionDigits: 0,
                                                            maximumFractionDigits: 2
                                                        }) + ' VND');

                                                        $("#order_total").val(orderTotal1)
                                                    },
                                                    error: function (err) {

                                                        total = 75000;

                                                        orderTotal1 = Number(orderTotal) + 75000;

                                                        $('#shipping-fee').text('75,000 VND');

                                                        $('#shipping_fee').val(total);

                                                        $('#order-total').text(orderTotal1.toLocaleString('en-US', {
                                                            minimumFractionDigits: 0,
                                                            maximumFractionDigits: 2
                                                        }) + ' VND');

                                                        $("#order_total").val(orderTotal1)
                                                    }

                                                });
                                            });
                                        }
                                    });
                                });
                            }
                        });
                    });
                }
            });


        });
    </script>
@endsection
