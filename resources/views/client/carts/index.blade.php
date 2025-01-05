@extends('client.layouts.main')

@section('styles')
@endsection

@section('content')
    <!--== Start Page Header Area Wrapper ==-->
    <div class="page-header-area" data-bg-img="{{ asset('theme/client/assets/img/photos/bg3.webp') }}">
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
                <div class="col-md-12 col-lg-8">
                    <div class="shopping-cart-form table-responsive">

                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th class="product-thumb">&nbsp;</th>
                                <th class="product-name">Product</th>
                                <th></th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-subtotal">Total</th>
                                <th class="product-remove">Actions</th>
                            </tr>
                            </thead>
                            <tbody id="list-cart-item">
                            @if($cart->cartItems->count())
                                @foreach($cart->cartItems as $item)
                                    <tr class="cart-product-item cart-item-{{ $item->id }}">
                                        <td class="product-thumb">
                                            <a href="{{ route('product.detail', $item->product->slug) }}">
                                                <img src="{{ Storage::url($item->product->image) }}" width="90"
                                                     height="110"
                                                     alt="Image-HasTech">
                                            </a>
                                        </td>
                                        <td class="product-name">
                                            <h4 class="title"><a
                                                    href="{{ route('product.detail', $item->product->slug) }}">{{ $item->product->name }}</a>
                                            </h4>
                                        </td>
                                        <td>
                                            @if($item->variant_id)
                                                <div>Variations:</div>
                                                <div>
                                                    @foreach($item->variant->attributeValues as $attrVal)
                                                        {{ $attrVal->name }},
                                                    @endforeach
                                                </div>
                                            @endif
                                        </td>
                                        <td class="product-price">
                                            @if($item->variant_id)
                                                @if($item->product->is_sale && $item->variant->price_sale)
                                                    <span class="price">{{ number_format($item->variant->price_sale) }} VND</span>
                                                @else
                                                    <span
                                                        class="price">{{ number_format($item->variant->price) }} VND</span>
                                                @endif
                                            @else
                                                @if($item->product->is_sale && $item->product->price_sale)
                                                    <span class="price">{{ number_format($item->product->price_sale) }} VND</span>
                                                @else
                                                    <span
                                                        class="price">{{ number_format($item->product->price) }} VND</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="product-quantity">
                                            <div class="pro-qty">
                                                <button class="dec qty-btn" data-qty-btn-id="{{ $item->id }}">-</button>
                                                <input type="text" class="quantity" name="quantity-{{ $item->id }}"
                                                       data-qty-id="{{ $item->id }}" title="Quantity"
                                                       value="{{ $item->quantity }}">
                                                <button class="inc qty-btn" data-qty-btn-id="{{ $item->id }}">+</button>
                                            </div>
                                        </td>
                                        <td class="product-subtotal product-subtotal-{{ $item->id }}">
                                            @if($item->variant_id)
                                                @if($item->product->is_sale && $item->variant->price_sale)
                                                    <span class="price" style="color: #eb3e32;">{{ number_format(intval($item->variant->price_sale) * intval($item->quantity)) }} VND</span>
                                                @else
                                                    <span class="price" style="color: #eb3e32;">{{ number_format(intval($item->variant->price) * intval($item->quantity)) }} VND</span>
                                                @endif
                                            @else
                                                @if($item->product->is_sale && $item->product->price_sale)
                                                    <span class="price" style="color: #eb3e32;">{{ number_format(intval($item->product->price_sale) * intval($item->quantity)) }} VND</span>
                                                @else
                                                    <span class="price" style="color: #eb3e32;">{{ number_format(intval($item->product->price) * intval($item->quantity)) }} VND</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="product-remove text-center">
                                            <button type="button" class="border-0 btn-delete-cart"
                                                    data-item-id="{{ $item->id }}"><i class="fa fa-trash-o"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">No product</td>
                                </tr>
                            @endif
                            </tbody>
                            <tr class="actions">
                                <td class="border-0" colspan="7">
                                    <button type="submit" class="update-cart" disabled>Update cart</button>
                                    <form action="{{ route('cart.clear', $cart->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="clear-cart">Clear Cart</button>
                                    </form>
                                    <a href="{{ route('shop') }}" class="btn-theme btn-flat">Continue Shopping</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <div class="shipping-form-cart-totals" style="background-color: #f7f7f7;">
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
                        <a class="btn-theme btn-flat" href="{{ route('checkout') }}">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')

    <script>
        $(document).ready(function () {


            $('.btn-delete-cart').click(function () {

                if (confirm('Are you sure?')) {
                    var cartItemID = $(this).attr('data-item-id');
                    var itemCart = $(`.item-cart-${cartItemID}`)
                    $.ajax({
                        url: `/cart/${cartItemID}`,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function (res) {
                            if (res.data) {
                                $(`.cart-item-${res.data.id}`).remove()
                                if (document.getElementById('list-cart-item').textContent.trim() === '') {
                                    document.getElementById('list-cart-item').innerHTML += `<tr> <td colspan="7">No product</td> </tr>`;
                                }
                                Toastify({

                                    text: `${res.message}`,

                                    duration: 3000,

                                    gravity: top,

                                    close: true,

                                    style: {background: 'red'},

                                }).showToast();
                            }
                        },
                        error: function (res) {

                        }
                    });
                }
            });

            $('.qty-btn').on('click', function (e) {
                e.preventDefault();
                var qtyBtnID = $(this).attr('data-qty-btn-id');
                var quantity = $(`input[name="quantity-${qtyBtnID}"]`).val();
                $.ajax({
                    url: `/cart/${qtyBtnID}`,
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        quantity: quantity
                    },
                    success: function (res) {
                        var data = res.data;
                        var product = res.data.product;
                        var variant = res.data.variant;
                        var totalPrice;
                        if (data.variant_id) {
                            if (product.is_sale && variant.price_sale) {
                                totalPrice = variant.price_sale
                            } else {
                                totalPrice = variant.price
                            }
                        } else {
                            if (product.is_sale && product.price_sale) {
                                totalPrice = product.price_sale
                            } else {
                                totalPrice = product.price
                            }
                        }

                        totalPrice = Number(totalPrice) * Number(data.quantity)
                        let formattedAmount = new Intl.NumberFormat('en-US').format(totalPrice);
                        // $('.prices').html(``);
                        $(`.product-subtotal-${data.id}`).html(`<span class="price" style="color: #eb3e32;">${formattedAmount} VND</span>`);
                    }
                });
            });

        });
    </script>
@endsection
