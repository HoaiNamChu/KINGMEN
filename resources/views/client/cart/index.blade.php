@extends('client.layouts.main')

@section('content')
    <!--== Start Page Header Area Wrapper ==-->
    <div class="page-header-area" data-bg-img="assets/img/photos/bg3.webp">
        <div class="container pt--0 pb--0">
            <div class="row">
                <div class="col-12">
                    <div class="page-header-content">
                        <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Shopping Cart</h2>
                        <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
                            <ul class="breadcrumb">
                                <li><a href="index.html">Home</a></li>
                                <li class="breadcrumb-sep">//</li>
                                <li>Shopping Cart</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--== End Page Header Area Wrapper ==-->

    <!--== Start Blog Area Wrapper ==-->
    <section class="shopping-cart-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart-form table-responsive">
                        <form action="#" method="post">
                            <table class="table text-center">
                                <thead>
                                <tr>
                                    <th class="product-remove">&nbsp;</th>
                                    <th class="product-thumb">&nbsp;</th>
                                    <th class="product-name">Product</th>
                                    <th>Variants</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $cartTotal = 0;
                                @endphp
                                @if ($cart->cartItems->count())
                                    @foreach ($cart->cartItems as $item)
                                        <tr class="cart-product-item">
                                            <td class="product-remove">
                                                <a href="#/"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                            <td class="product-thumb">
                                                <a href="{{ route('product.detail', $item->product->slug)}}">
                                                    <img src="{{ Storage::url($item->product->image) }}" width="90"
                                                         height="110" alt="Image-HasTech">
                                                </a>
                                            </td>
                                            <td class="product-name">
                                                <h4 class="title"><a
                                                        href="{{ route('product.detail', $item->product->slug)}}">{{ $item->product->name }}</a>
                                                </h4>
                                            </td>
                                            <td>
                                                @if($item->variant_id)
                                                    @foreach($attributes as $attribute)
                                                        <select name="" id="">
                                                            @foreach($attribute->attributeValues as $attributeValue)
                                                                <option value="{{ $attributeValue->id }}"
                                                                        @foreach($item->variant->attributeValues as $value)
                                                                            @if($attributeValue->id == $value->id)
                                                                                selected
                                                                    @endif
                                                                    @endforeach
                                                                >{{ $attributeValue->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="product-price">
                                                @if($item->variant)
                                                    @if ($item->product->is_sale && $item->variant->price_sale > 0)
                                                        <span
                                                            class="price">{{ number_format($item->variant->price_sale) }} VND</span>
                                                    @else
                                                        <span
                                                            class="price">{{ number_format($item->variant->price) }} VND</span>
                                                    @endif
                                                @else
                                                    @if ($item->product->is_sale && $item->product->price_sale > 0)
                                                        <span
                                                            class="price">{{ number_format($item->product->price_sale) }} VND</span>
                                                    @else
                                                        <span
                                                            class="price">{{ number_format($item->product->price) }} VND</span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="product-quantity">
                                                <div class="pro-qty">
                                                    <input type="text" class="quantity" title="Quantity"
                                                           value="{{ $item->quantity }}">
                                                </div>
                                            </td>
                                            <td class="product-subtotal">
                                                @if($item->variant)
                                                    @if ($item->product->is_sale && $item->variant->price_sale > 0)
                                                        @php
                                                            $cartTotal += intval($item->variant->price_sale) * $item->quantity;
                                                        @endphp
                                                        <span
                                                            class="price">{{ number_format(intval($item->variant->price_sale) * $item->quantity) }} VND VND</span>
                                                    @else
                                                        @php
                                                            $cartTotal += intval($item->variant->price) * $item->quantity;
                                                        @endphp
                                                        <span
                                                            class="price">{{ number_format(intval($item->variant->price) * $item->quantity) }} VND VND</span>
                                                    @endif
                                                @else
                                                    @if ($item->product->is_sale && $item->product->price_sale > 0)
                                                        @php
                                                            $cartTotal += intval($item->product->price_sale) * $item->quantity;
                                                        @endphp
                                                        <span
                                                            class="price">{{ number_format(intval($item->product->price_sale) * $item->quantity) }} VND VND</span>
                                                    @else
                                                        @php
                                                            $cartTotal += intval($item->product->price) * $item->quantity;
                                                        @endphp
                                                        <span
                                                            class="price">{{ number_format(intval($item->product->price) * $item->quantity) }} VND VND</span>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7">
                                            <span>No product in cart!</span>
                                        </td>
                                    </tr>
                                @endif

                                <tr class="actions">
                                    <td class="border-0" colspan="7">
                                        <button type="submit" class="update-cart" disabled>Update cart</button>
                                        <a href="{{ route('cart.clear') }}">
                                            <button type="button"
                                                    class="clear-cart">Clear Cart
                                            </button>
                                        </a>
                                        <a href="{{ route('shop') }}" class="btn-theme btn-flat">Continue Shopping</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row row-gutter-50">
                {{--                <div class="col-md-6 col-lg-4">--}}
                {{--                    <div id="CategoriesAccordion" class="shipping-form-calculate">--}}
                {{--                        <div class="section-title-cart">--}}
                {{--                            <h5 class="title">Calculate Shipping</h5>--}}
                {{--                            <div class="desc">--}}
                {{--                                <p>Estimate your shipping fee *</p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <span data-bs-toggle="collapse" data-bs-target="#CategoriesTwo" aria-expanded="true"--}}
                {{--                              role="button">Calculate shipping</span>--}}
                {{--                        <div id="CategoriesTwo" class="collapse show" data-bs-parent="#CategoriesAccordion">--}}

                {{--                            <div class="row row-gutter-50">--}}

                {{--                                <div class="col-md-12">--}}
                {{--                                    <div class="form-group">--}}
                {{--                                        <label class="visually-hidden" for="city">City</label>--}}
                {{--                                        <select id="city" name="city" class="form-control">--}}
                {{--                                            <option value="0">City</option>--}}
                {{--                                        </select>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                                <div class="col-md-12">--}}
                {{--                                    <div class="form-group">--}}
                {{--                                        <label class="visually-hidden" for="district">District</label>--}}
                {{--                                        <select id="district" name="district" class="form-control">--}}
                {{--                                            <option value="0">District</option>--}}
                {{--                                        </select>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                                <div class="col-md-12">--}}
                {{--                                    <div class="form-group">--}}
                {{--                                        <label class="visually-hidden" for="ward">Ward</label>--}}
                {{--                                        <select id="ward" name="ward" class="form-control">--}}
                {{--                                            <option value="0">Ward</option>--}}
                {{--                                        </select>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}

                {{--                                <div class="col-md-12">--}}
                {{--                                    <div class="form-group">--}}
                {{--                                        <button type="button" class="update-totals">Update totals</button>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}

                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="col-md-6 col-lg-4">--}}
                {{--                    <div class="shipping-form-coupon">--}}
                {{--                        <div class="section-title-cart">--}}
                {{--                            <h5 class="title">Coupon Code</h5>--}}
                {{--                            <div class="desc">--}}
                {{--                                <p>Enter your coupon code if you have one.</p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <form action="#" method="post">--}}
                {{--                            <div class="row">--}}
                {{--                                <div class="col-md-12">--}}
                {{--                                    <div class="form-group">--}}
                {{--                                        <label class="visually-hidden" for="couponCode">Coupon Code</label>--}}
                {{--                                        <select id="couponCode" name="couponCode" class="form-control">--}}
                {{--                                            <option value="0">Select your coupon code..</option>--}}
                {{--                                        </select>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                                <div class="col-md-12">--}}
                {{--                                    <div class="form-group">--}}
                {{--                                        <button type="button" class="coupon-btn">Apply coupon</button>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </form>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <div class="col-md-12 col-lg-4 ms-lg-auto">
                    <div class="shipping-form-cart-totals">
                        <div class="section-title-cart">
                            <h5 class="title">Cart totals: {{ number_format( $cartTotal)  }} VND</h5>
                        </div>
                        <div class="cart-total-table">
                            {{--                            <table class="table">--}}
                            {{--                                <tbody>--}}
                            {{--                                <tr class="cart-subtotal">--}}
                            {{--                                    <td>--}}
                            {{--                                        <p class="value">Subtotal</p>--}}
                            {{--                                    </td>--}}
                            {{--                                    <td>--}}
                            {{--                                        <p class="price">{{ number_format( $cartTotal)  }} VND</p>--}}
                            {{--                                    </td>--}}
                            {{--                                </tr>--}}
                            {{--                                <tr class="shipping">--}}
                            {{--                                    <td>--}}
                            {{--                                        <p class="value">Shipping fee</p>--}}
                            {{--                                    </td>--}}
                            {{--                                    <td>--}}
                            {{--                                        <ul class="shipping-list">--}}
                            {{--                                            <li class="radio">--}}
                            {{--                                                <input type="radio" name="shipping" id="radio1" checked>--}}
                            {{--                                                <label for="radio1"><span></span> Flat Rate</label>--}}
                            {{--                                            </li>--}}
                            {{--                                            <li class="radio">--}}
                            {{--                                                <input type="radio" name="shipping" id="radio2">--}}
                            {{--                                                <label for="radio2"><span></span> Free Shipping</label>--}}
                            {{--                                            </li>--}}
                            {{--                                            <li class="radio">--}}
                            {{--                                                <input type="radio" name="shipping" id="radio3">--}}
                            {{--                                                <label for="radio3"><span></span> Local Pickup</label>--}}
                            {{--                                            </li>--}}
                            {{--                                        </ul>--}}
                            {{--                                    </td>--}}
                            {{--                                </tr>--}}
                            {{--                                <tr class="voucher">--}}
                            {{--                                    <td>--}}
                            {{--                                        <p class="value">Voucher</p>--}}
                            {{--                                    </td>--}}
                            {{--                                    <td>--}}
                            {{--                                        <p class="price">0 VND</p>--}}
                            {{--                                    </td>--}}
                            {{--                                </tr>--}}
                            {{--                                <tr class="order-total">--}}
                            {{--                                    <td>--}}
                            {{--                                        <p class="value">Total</p>--}}
                            {{--                                    </td>--}}
                            {{--                                    <td>--}}
                            {{--                                        <p class="price">{{ number_format( $cartTotal)  }} VND</p>--}}
                            {{--                                    </td>--}}
                            {{--                                </tr>--}}
                            {{--                                </tbody>--}}
                            {{--                            </table>--}}
                        </div>
                        <a class="btn-theme btn-flat" href="{{ route('checkout') }}">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== End Blog Area Wrapper ==-->
@endsection

@section('lib-script')

@endsection

@section('script')
    <script>
        $(document).ready(function () {

            $.ajax({
                url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/province',
                type: 'GET',
                dataType: "json",
                headers: {
                    'token': 'f3dc65c5-96db-11ef-97be-1ef9613dbf99'
                },
                success: function (data_city) {
                    $.each(data_city.data, function (key_tinh, val_tinh) {
                        $("#city").append('<option value="' + val_tinh.ProvinceID + '">' + val_tinh.ProvinceName + '</option>');
                    });
                    $("#city").change(function (e) {
                        var idCity = $(this).val();
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
                                    $("#district").append('<option value="' + val_quan.DistrictID + '">' + val_quan.DistrictName + '</option>');
                                });
                                //Lấy phường xã
                                $("#district").change(function (e) {
                                    var idDistrict = $(this).val();
                                    console.log(idDistrict)
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
                                                $("#ward").append('<option value="' + val_phuong.WardID + '">' + val_phuong.WardName + '</option>');
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
