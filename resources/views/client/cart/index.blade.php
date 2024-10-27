@extends('client.layouts.main')

@section('content')
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
                        {{-- <form action="#" method="post"> --}}
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
                                @foreach ($cartItems as $item)
                                    <tr class="cart-product-item">
                                        <form action="{{ route('destroyCart', $item->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <td class="remove">
                                                <button type="submit" class="btn btn-light"><i
                                                        class="fa fa-trash-o"></i></button>
                                                {{-- <a href="{{route('destroyCart',$item->id)}}"><i class="fa fa-trash-o"></i></a> --}}
                                            </td>
                                        </form>

                                        <td class="product-thumb">
                                            <a href="{{ route('productDetail', $item->product->slug) }}">
                                                <img src="{{ Storage::url($item->product->image) }}" width="90" height="110"
                                                    alt="Image-HasTech">
                                            </a>
                                        </td>
                                        <td class="product-name">
                                            <h4 class="title"><a href="{{ route('productDetail', $item->product->slug) }}">{{ $item->product->name }}</a>
                                            </h4>
                                        </td>
                                        <td class="product-price">
                                            <span class="price">{{ number_format( $item->product->price) }}$</span>
                                        </td>
                                        <td class="product-quantity">
                                            <div class="pro-qty">
                                                <input type="text" class="quantity" title="Quantity" name="quantity"
                                                    value="{{ $item->quantity }}">
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            <span
                                                class="price">{{ number_format($item->product->price) * $item->quantity }}$</span>
                                        </td>
                                    </tr>
                                @endforeach


                                <tr class="actions">
                                    <td class="border-0" colspan="4">
                                        <a href="/" class="btn-theme btn-flat">Continue Shopping</a>
                                        <form action="{{ route('updateCart') }}" method="post">
                                            @csrf
                                            @method('PUT')
                                        <td class="remove">
                                        <button type="submit" class="update-cart" disabled>Update cart</button>
                                        {{-- <button type="submit" class="clear-cart">Clear Cart</button> --}}
                                        {{-- <button type="submit" class="btn btn-light"><i
                                                            class="fa fa-trash-o"></i></button> --}}
                                        {{-- <a href="{{route('destroyCart',$item->id)}}"><i class="fa fa-trash-o"></i></a> --}}
                                    </td>
                                    </form>
                                    <form action="{{ route('destroyAllCart') }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <td class="remove">
                                            <button type="submit" class="clear-cart">Clear Cart</button>
                                            {{-- <button type="submit" class="btn btn-light"><i
                                                            class="fa fa-trash-o"></i></button> --}}
                                            {{-- <a href="{{route('destroyCart',$item->id)}}"><i class="fa fa-trash-o"></i></a> --}}
                                        </td>
                                    </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
            <div class="row row-gutter-50">
                <div class="col-md-6 col-lg-4">
                    <div id="CategoriesAccordion" class="shipping-form-calculate">
                        <div class="section-title-cart">
                            <h5 class="title">Calculate Shipping</h5>
                            <div class="desc">
                                <p>Estimate your shipping fee *</p>
                            </div>
                        </div>
                        <span data-bs-toggle="collapse" data-bs-target="#CategoriesTwo" aria-expanded="true"
                            role="button">Calculate shipping</span>
                        <div id="CategoriesTwo" class="collapse show" data-bs-parent="#CategoriesAccordion">
                            <form action="#" method="post">
                                <div class="row row-gutter-50">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="visually-hidden" for="FormCountry">State</label>
                                            <select id="FormCountry" class="form-control">
                                                <option selected>Select a country…</option>
                                                <option>...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="stateCounty" class="visually-hidden">State / County</label>
                                            <input type="text" id="stateCounty" class="form-control"
                                                placeholder="State / County">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="townCity" class="visually-hidden">Town / City</label>
                                            <input type="text" id="townCity" class="form-control"
                                                placeholder="Town / City">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="postcodeZip" class="visually-hidden">Postcode / ZIP</label>
                                            <input type="text" id="postcodeZip" class="form-control"
                                                placeholder="Postcode / ZIP">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="update-totals">Update totals</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="shipping-form-coupon">
                        <div class="section-title-cart">
                            <h5 class="title">Coupon Code</h5>
                            <div class="desc">
                                <p>Enter your coupon code if you have one.</p>
                            </div>
                        </div>
                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="couponCode" class="visually-hidden">Coupon Code</label>
                                        <input type="text" id="couponCode" class="form-control"
                                            placeholder="Enter your coupon code..">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="coupon-btn">Apply coupon</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <div class="shipping-form-cart-totals">
                        <div class="section-title-cart">
                            <h5 class="title">Cart totals</h5>
                        </div>
                        <div class="cart-total-table">
                            <table class="table">
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <td>
                                            <p class="value">Subtotal</p>
                                        </td>
                                        <td>
                                            <p class="price">£128.00</p>
                                        </td>
                                    </tr>
                                    <tr class="shipping">
                                        <td>
                                            <p class="value">Shipping</p>
                                        </td>
                                        <td>
                                            <ul class="shipping-list">
                                                <li class="radio">
                                                    <input type="radio" name="shipping" id="radio1" checked>
                                                    <label for="radio1"><span></span> Flat Rate</label>
                                                </li>
                                                <li class="radio">
                                                    <input type="radio" name="shipping" id="radio2">
                                                    <label for="radio2"><span></span> Free Shipping</label>
                                                </li>
                                                <li class="radio">
                                                    <input type="radio" name="shipping" id="radio3">
                                                    <label for="radio3"><span></span> Local Pickup</label>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <td>
                                            <p class="value">Total</p>
                                        </td>
                                        <td>
                                            <p class="price">£128.00</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a class="btn-theme btn-flat" href="shop-checkout.html">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
