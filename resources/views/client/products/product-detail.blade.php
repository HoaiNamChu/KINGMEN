@extends('client.layouts.main')

@section('styles')
    <style>
        /*.product-single-item .product-single-info .product-attribute .attribute-list {*/
        /*    display: flex;*/
        /*    gap: 10px;*/
        /*}*/

        /*.attribute-checkbox {*/
        /*    position: relative;*/
        /*    display: inline-block;*/
        /*    cursor: pointer;*/
        /*}*/

        .attribute-checkbox input[type="checkbox"] {
            display: none;
        }

        .attribute-checkbox span {
            display: inline-block;
            padding: 10px 20px;
            border: 2px solid #000;
            border-radius: 4px;
            background-color: #fff;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .attribute-checkbox input[type="checkbox"]:checked + span {
            background-color: #000;
            color: #fff;
        }

    </style>
@endsection

@section('content')
    <!--== Start Page Header Area Wrapper ==-->
    <div class="page-header-area" data-bg-img="assets/img/photos/bg3.webp">
        <div class="container pt--0 pb--0">
            <div class="row">
                <div class="col-12">
                    <div class="page-header-content">
                        <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Product Details</h2>
                        <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
                            <ul class="breadcrumb">
                                <li><a href="index.html">Home</a></li>
                                <li class="breadcrumb-sep">//</li>
                                <li>Product Details</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--== End Page Header Area Wrapper ==-->

    <!--== Start Product Single Area Wrapper ==-->
    <section class="product-area product-single-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-single-item">
                        <div class="row">
                            <div class="col-xl-6">
                                <!--== Start Product Thumbnail Area ==-->
                                <div class="product-single-thumb">
                                    <div class="swiper-container single-product-thumb single-product-thumb-slider">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide"
                                                 style="display: flex; justify-content: center; align-items: center;">
                                                <a class="lightbox-image" data-fancybox="gallery"
                                                   href="{{ Storage::url($product->image) }}"
                                                   style="height: 100%; width: 100%;">
                                                    <img src="{{ Storage::url($product->image) }}" width="570px"
                                                         height="541px" alt="Image-HasTech">
                                                </a>
                                            </div>
                                            @if($product->galleries->count())
                                                @foreach($product->galleries as $item)
                                                    <div class="swiper-slide "
                                                         style="display: flex; justify-content: center; align-items: center;">
                                                        <a class="lightbox-image" data-fancybox="gallery"
                                                           href="{{ Storage::url($item->image) }}"
                                                           style="height: 100%; width: 100%;">
                                                            <img src="{{ Storage::url($item->image) }}" width="570px"
                                                                 height="541px" alt="Image-HasTech">
                                                        </a>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="swiper-container single-product-nav single-product-nav-slider">
                                        <div class="swiper-wrapper">
                                            @if($product->image)
                                                <div class="swiper-slide">
                                                    <img src="{{ Storage::url($product->image) }}" width="127"
                                                         height="127" alt="Image-HasTech">
                                                </div>
                                            @endif
                                            @if($product->galleries->count())
                                                @foreach($product->galleries as $item)
                                                    <div class="swiper-slide">
                                                        <img src="{{ Storage::url($item->image) }}" width="127"
                                                             height="127" alt="Image-HasTech">
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!--== End Product Thumbnail Area ==-->
                            </div>
                            <div class="col-xl-6">
                                <!--== Start Product Info Area ==-->
                                <div class="product-single-info">
                                    <h3 class="main-title">{{ $product->name }}</h3>
                                    <div class="prices">
                                        @if($product->attributes->count())
                                            <span class="price">{{ number_format($product->price_sale) }} VND</span>
                                            <span class="sep">-</span>
                                            <span class="price">{{ number_format($product->price) }} VND</span>
                                        @else
                                            @if($product->is_sale && $product->price_sale > 0)
                                                <span class="price-old" style="text-decoration: line-through">{{ number_format($product->price) }} VND</span>
                                                <span class="sep">-</span>
                                                <span class="price">{{ number_format($product->price_sale) }} VND</span>
                                            @else
                                                <span class="price">{{ number_format($product->price) }} VND</span>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="rating-box-wrap">
                                        <div class="rating-box">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="review-status">
                                            <a href="javascript:void(0)">(5 Customer Review)</a>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consecte adipisicing elit, sed do eiusmll tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad mill veniam, quis
                                        nostrud exercitation ullamco laboris nisi ut aliquip exet commodo consequat.
                                        Duis aute irure dolor</p>
                                    @if($product->attributes->count())
                                        @foreach($product->attributes as $attribute)
                                            <div class="product-attribute">
                                                <h6 class="title">{{ $attribute->name }}</h6>
                                                <ul class="attribute-list">
                                                    @foreach($product->attributeValues as $value)
                                                        @if($value->attribute_id == $attribute->id)
                                                            <li><label for="{{ $value->id  }}"
                                                                       class="attribute-checkbox">
                                                                    <input type="checkbox" name="{{ $attribute->id }}"
                                                                           id="{{ $value->id  }}"
                                                                           value="{{ $value->id }}">
                                                                    <span>{{ $value->name }}</span>
                                                                </label></li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="product-quick-action">
                                        <div class="qty-wrap">
                                            <div class="pro-qty">
                                                <input type="text" title="Quantity" value="1">
                                            </div>
                                        </div>
                                        <a class="btn-theme" href="shop-cart.html">Add to Cart</a>
                                    </div>
                                    <div class="product-wishlist-compare">
                                        <a href="shop-wishlist.html"><i class="pe-7s-like"></i>Add to Wishlist</a>
                                        <a href="shop-compare.html"><i class="pe-7s-shuffle"></i>Add to Compare</a>
                                    </div>
                                    <div class="product-info-footer">
                                        <h6 class="code"><span>Code :</span>{{ $product->sku }}</h6>
                                        <div class="social-icons">
                                            <span>Share</span>
                                            <a href="#/"><i class="fa fa-facebook"></i></a>
                                            <a href="#/"><i class="fa fa-dribbble"></i></a>
                                            <a href="#/"><i class="fa fa-pinterest-p"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <!--== End Product Info Area ==-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="product-review-tabs-content">
                        <ul class="nav product-tab-nav" id="ReviewTab" role="tablist">
                            <li role="presentation">
                                <a class="active" id="information-tab" data-bs-toggle="pill" href="#information"
                                   role="tab" aria-controls="information" aria-selected="true">Information</a>
                            </li>
                            <li role="presentation">
                                <a id="description-tab" data-bs-toggle="pill" href="#description" role="tab"
                                   aria-controls="description" aria-selected="false">Description</a>
                            </li>
                            <li role="presentation">
                                <a id="reviews-tab" data-bs-toggle="pill" href="#reviews" role="tab"
                                   aria-controls="reviews" aria-selected="false">Reviews <span>(05)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content product-tab-content" id="ReviewTabContent">
                            <div class="tab-pane fade show active" id="information" role="tabpanel"
                                 aria-labelledby="information-tab">
                                <div class="product-information">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim adlo minim
                                        veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                        commodo consequat. Duis aute irure dolor in tun tuni reprehenderit in
                                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
                                        occaecat cupidatat non proident, sunt in culpa qui officia deserun mollit
                                        anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit
                                        voluptatem accusantium doloremque laudantium, totam rel aperiam, eaque ipsa
                                        quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt
                                        explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit
                                        aut fugit, sed quia consequuntur.</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="description" role="tabpanel"
                                 aria-labelledby="description-tab">
                                <div class="product-description">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim adlo minim
                                        veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                        commodo consequat. Duis aute irure dolor in tun tuni reprehenderit in
                                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
                                        occaecat cupidatat non proident, sunt in culpa qui officia deserun mollit
                                        anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit
                                        voluptatem accusantium doloremque laudantium, totam rel aperiam, eaque ipsa
                                        quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt
                                        explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit
                                        aut fugit, sed quia consequuntur.</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                <div class="product-review-content">
                                    <div class="review-content-header">
                                        <h3>Customer Reviews</h3>
                                        <div class="review-info">
                                            <ul class="review-rating">
                                                <li class="fa fa-star"></li>
                                                <li class="fa fa-star"></li>
                                                <li class="fa fa-star"></li>
                                                <li class="fa fa-star"></li>
                                                <li class="fa fa-star-o"></li>
                                            </ul>
                                            <span class="review-caption">Based on 5 reviews</span>
                                            <span class="review-write-btn">Write a review</span>
                                        </div>
                                    </div>

                                    <!--== Start Reviews Form Item ==-->
                                    <div class="reviews-form-area">
                                        <h4 class="title">Write a review</h4>
                                        <div class="reviews-form-content">
                                            <form action="#">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="for_name">Name</label>
                                                            <input id="for_name" class="form-control" type="text"
                                                                   placeholder="Enter your name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="for_email">Email</label>
                                                            <input id="for_email" class="form-control" type="email"
                                                                   placeholder="john.smith@example.com">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <span class="title">Rating</span>
                                                            <ul class="review-rating">
                                                                <li class="fa fa-star-o"></li>
                                                                <li class="fa fa-star-o"></li>
                                                                <li class="fa fa-star-o"></li>
                                                                <li class="fa fa-star-o"></li>
                                                                <li class="fa fa-star-o"></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="for_review-title">Review Title</label>
                                                            <input id="for_review-title" class="form-control"
                                                                   type="text"
                                                                   placeholder="Give your review a title">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="for_comment">Body of Review (1500)</label>
                                                            <textarea id="for_comment" class="form-control"
                                                                      placeholder="Write your comments here"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-submit-btn">
                                                            <button type="submit" class="btn-submit">Post comment
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!--== End Reviews Form Item ==-->

                                    <div class="reviews-content-body">
                                        <!--== Start Reviews Content Item ==-->
                                        <div class="review-item">
                                            <ul class="review-rating">
                                                <li class="fa fa-star"></li>
                                                <li class="fa fa-star"></li>
                                                <li class="fa fa-star"></li>
                                                <li class="fa fa-star"></li>
                                                <li class="fa fa-star"></li>
                                            </ul>
                                            <h3 class="title">Awesome shipping service!</h3>
                                            <h5 class="sub-title"><span>Nantu Nayal</span> no
                                                <span>Sep 30, 2022</span></h5>
                                            <p>It has survived not only five centuries, but also the leap into
                                                electronic typesetting, remaining essentially unchanged. It was
                                                popularised in the 1960s with the release of Letraset sheets
                                                containing Lorem Ipsum passages, and more recently with desktop
                                                publishing software like Aldus PageMaker including versions of Lorem
                                                Ipsum.</p>
                                            <a href="#/">Report as Inappropriate</a>
                                        </div>
                                        <!--== End Reviews Content Item ==-->

                                        <!--== Start Reviews Content Item ==-->
                                        <div class="review-item">
                                            <ul class="review-rating">
                                                <li class="fa fa-star"></li>
                                                <li class="fa fa-star-o"></li>
                                                <li class="fa fa-star-o"></li>
                                                <li class="fa fa-star-o"></li>
                                                <li class="fa fa-star-o"></li>
                                            </ul>
                                            <h3 class="title">Low Quality</h3>
                                            <h5 class="sub-title"><span>Oliv hala</span> no
                                                <span>Sep 30, 2022</span></h5>
                                            <p>My Favorite White Sneakers From Splurge To Save the 1500s is
                                                reproduced below for those interested. Sections 1.10.32 and 1.10.33
                                                from "de Finibus Bonorum et Malorum" by Cicero are also reproduced
                                                in their exact original form, accompanied by English versions from
                                                the 1914 translation by H. Rackham.</p>
                                            <a href="#/">Report as Inappropriate</a>
                                        </div>
                                        <!--== End Reviews Content Item ==-->

                                        <!--== Start Reviews Content Item ==-->
                                        <div class="review-item">
                                            <ul class="review-rating">
                                                <li class="fa fa-star"></li>
                                                <li class="fa fa-star"></li>
                                                <li class="fa fa-star"></li>
                                                <li class="fa fa-star"></li>
                                                <li class="fa fa-star"></li>
                                            </ul>
                                            <h3 class="title">Excellent services!</h3>
                                            <h5 class="sub-title"><span>Halk Marron</span> no
                                                <span>Sep 30, 2022</span></h5>
                                            <p>The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes
                                                from a line in section 1.10.32.</p>
                                            <a href="#/">Report as Inappropriate</a>
                                        </div>
                                        <!--== End Reviews Content Item ==-->

                                        <!--== Start Reviews Content Item ==-->
                                        <div class="review-item">
                                            <ul class="review-rating">
                                                <li class="fa fa-star"></li>
                                                <li class="fa fa-star"></li>
                                                <li class="fa fa-star"></li>
                                                <li class="fa fa-star-o"></li>
                                                <li class="fa fa-star-o"></li>
                                            </ul>
                                            <h3 class="title">Price is very high</h3>
                                            <h5 class="sub-title"><span>Musa</span> no <span>Sep 30, 2022</span>
                                            </h5>
                                            <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It
                                                has roots in a piece of classical Latin literature from 45 BC,
                                                making it over 2000 years old.</p>
                                            <a href="#/">Report as Inappropriate</a>
                                        </div>
                                        <!--== End Reviews Content Item ==-->

                                        <!--== Start Reviews Content Item ==-->
                                        <div class="review-item">
                                            <ul class="review-rating">
                                                <li class="fa fa-star"></li>
                                                <li class="fa fa-star"></li>
                                                <li class="fa fa-star"></li>
                                                <li class="fa fa-star"></li>
                                                <li class="fa fa-star-o"></li>
                                            </ul>
                                            <h3 class="title">Normal</h3>
                                            <h5 class="sub-title"><span>Muhammad</span> no <span>Sep 30, 2022</span>
                                            </h5>
                                            <p>There are many variations of passages of Lorem Ipsum available, but
                                                the majority have suffered alteration in some form, by injected
                                                humour</p>
                                            <a href="#/">Report as Inappropriate</a>
                                        </div>
                                        <!--== End Reviews Content Item ==-->
                                    </div>

                                    <!--== Start Reviews Pagination Item ==-->
                                    <div class="review-pagination">
                                        <span class="pagination-pag">1</span>
                                        <span class="pagination-pag">2</span>
                                        <span class="pagination-next">Next »</span>
                                    </div>
                                    <!--== End Reviews Pagination Item ==-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== End Product Single Area Wrapper ==-->

    <!--== Start Product Area Wrapper ==-->
    <section class="product-area product-best-seller-area">
        <div class="container pt--0">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h3 class="title">Related Products</h3>
                        <div class="desc">
                            <p>There are many variations of passages of Lorem Ipsum available</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-slider-wrap">
                        <div class="swiper-container product-slider-col4-container">
                            <div class="swiper-wrapper">
                                @if(isset($relatedProducts))
                                    @foreach($relatedProducts as $item)
                                        <div class="swiper-slide">
                                            <!--== Start Product Item ==-->
                                            @include('client.components.product-item', ['item' => $item])
                                            <!--== End prPduct Item ==-->
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <!--== Add Swiper Arrows ==-->
                        <div class="product-swiper-btn-wrap">
                            <div class="product-swiper-btn-prev">
                                <i class="fa fa-arrow-left"></i>
                            </div>
                            <div class="product-swiper-btn-next">
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== End Product Area Wrapper ==-->
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            const originalContent = $(".prices").html();
            $('input[type="checkbox"]').change(function () {
                var valueID = [];
                var product_id =  {{ $product->id }};

                $('input[type="checkbox"]:checked').each(function () {
                    let value = $(this).val();
                    if (value !== 'on') {
                        valueID.push(value);
                    }
                })

                $.ajax({
                    url: '{{ route('variant.information') }}',
                    method: 'GET',
                    data: {
                        product_id: product_id,
                        attributeValueID: valueID,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res){
                        if(res.data.length){
                            var price = res.data[0].price

                            let formattedAmount = new Intl.NumberFormat('vi-VN').format(price);
                            // $('.prices').html(``);
                            $('.prices').html(`<span class="price">${formattedAmount} VND</span>`);

                        }else {
                            $('prices').html(originalContent)
                        }
                    },
                    error: function (res){
                        $('prices').html(originalContent)
                    }
                });

            });
        })
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const groups = document.querySelectorAll('.attribute-list');
            groups.forEach(group => {
                const checkboxes = group.querySelectorAll('input[type="checkbox"]');

                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function () {
                        if (this.checked) {
                            checkboxes.forEach(cb => {
                                if (cb !== this) {
                                    cb.checked = false;
                                }
                            });
                        }
                    });
                });
            });


        });
    </script>
@endsection
