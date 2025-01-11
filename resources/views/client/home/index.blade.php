@extends('client.layouts.main')

@section('content')
    <!--== Start Hero Area Wrapper ==-->
    <section class="home-slider-area">
        <div
            class="swiper-container home-slider-container default-slider-container swiper-container-fade swiper-container-initialized swiper-container-horizontal swiper-container-autoheight">
            <div class="swiper-wrapper home-slider-wrapper slider-default"
                 style="transition-duration: 0ms; height: 748px;">
                @foreach($sliders as $item)
                    <div class="swiper-slide swiper-slide-active" data-swiper-slide-index="{{ $item->id }}"
                         style="width: 1519px; transition-duration: 0ms; opacity: 1; transform: translate3d(-1519px, 0px, 0px);">
                        <div class="slider-content-area slider-content-area-two"
                             data-bg-img="{{ Storage::url($item->image) }}"
                             style="background-image: url(&quot;{{ Storage::url($item->image) }}&quot;);">
                            <div class="container">
                                <div class="slider-container">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-lg-5">
                                            <div class="slider-content">
                                                <div class="content">
                                                    <div class="desc-box">
                                                        <p class="desc">{{ $item->content }}</p>
                                                    </div>
                                                    <div class="title-box">
                                                        <h2 class="title"><span
                                                                class="font-weight-400">{{ $item->title }}</h2>
                                                    </div>
                                                    <div class="btn-box">
                                                        <a class="btn-slider" href="{{ route('shop') }}">Shop Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!--== Add Swiper Arrows ==-->
            <div class="swiper-btn-wrap">
                <div class="swiper-btn-prev" tabindex="0" role="button" aria-label="Previous slide">
                    <i class="pe-7s-angle-left"></i>
                </div>
                <div class="swiper-btn-next" tabindex="0" role="button" aria-label="Next slide">
                    <i class="pe-7s-angle-right"></i>
                </div>
            </div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
    </section>
    <!--== End Hero Area Wrapper ==-->

    <!--== Start Product Collection Area Wrapper ==-->
    <section class="product-area product-collection-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!--== Start Product Collection Item ==-->
                    <div class="product-collection">
                        <div class="inner-content">
                            <div class="product-collection-content">
                                <div class="content">
                                    <h3 class="title"><a href="shop.html">Sports Shoes</a></h3>
                                    <h4 class="price">From $95.00</h4>
                                </div>
                            </div>
                            <div class="product-collection-thumb"
                                 data-bg-img="{{ asset('theme/client/assets/img/shop/collection/1.webp') }}"></div>
                            <a class="banner-link-overlay" href="shop.html"></a>
                        </div>
                    </div>
                    <!--== End Product Collection Item ==-->
                </div>
                <div class="col-lg-4 col-md-6">
                    <!--== Start Product Collection Item ==-->
                    <div class="product-collection">
                        <div class="inner-content">
                            <div class="product-collection-content">
                                <div class="content">
                                    <h3 class="title"><a href="shop.html">Latest Shoes</a></h3>
                                    <h4 class="price">From $90.00</h4>
                                </div>
                            </div>
                            <div class="product-collection-thumb"
                                 data-bg-img="{{ asset('theme/client/assets/img/shop/collection/2.webp') }}"></div>
                            <a class="banner-link-overlay" href="shop.html"></a>
                        </div>
                    </div>
                    <!--== End Product Collection Item ==-->
                </div>
                <div class="col-lg-4 col-md-6">
                    <!--== Start Product Collection Item ==-->
                    <div class="product-collection">
                        <div class="inner-content">
                            <div class="product-collection-content">
                                <div class="content">
                                    <h3 class="title"><a href="shop.html">Office Shoes</a></h3>
                                    <h4 class="price">From $82.00</h4>
                                </div>
                            </div>
                            <div class="product-collection-thumb"
                                 data-bg-img="{{ asset('theme/client/assets/img/shop/collection/3.webp') }}"></div>
                            <a class="banner-link-overlay" href="shop.html"></a>
                        </div>
                    </div>
                    <!--== End Product Collection Item ==-->
                </div>
            </div>
        </div>
    </section>
    <!--== End Product Collection Area Wrapper ==-->

    <!--== Start Product Area Wrapper ==-->
    <section class="product-area product-default-area">
        <div class="container pt--0">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h3 class="title">Featured Items</h3>
                        <div class="desc">
                            <p>There are many variations of passages of Lorem Ipsum available</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($products as $item)
                    @if($item->is_featured)
                        <div class="col-sm-6 col-lg-3">
                            <!--== Start Product Item ==-->
                            @include('client.components.product-item', ['item' => $item])
                            <!--== End prPduct Item ==-->
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <!--== End Product Area Wrapper ==-->

    <!--== Start Divider Area Wrapper ==-->
    <section class="bg-color-f2 position-relative z-index-1">
        <div class="container pt--0 pb--0">
            <div class="row divider-wrap divider-style1">
                <div class="col-lg-6">
                    <div class="divider-content" data-title="NEW">
                        <h4 class="sub-title">Saving 50%</h4>
                        <h2 class="title">All Online Store</h2>
                        <p class="desc">Offer Available All Shoes & Products</p>
                        <a class="btn-theme" href="shop.html">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-layer-wrap">
            <div class="bg-layer-style z-index--1 parallax" data-speed="1.05"
                 data-bg-img="{{ asset('theme/client/assets/img/photos/bg1.webp') }}"></div>
        </div>
    </section>
    <!--== End Divider Area Wrapper ==-->

    <!--== Start Product Area Wrapper ==-->
    <section class="product-area product-best-seller-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h3 class="title">Best Seller</h3>
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
                                @foreach($products as $item)
                                    @if($item->is_best_seller)
                                        <div class="swiper-slide">
                                            <!--== Start Product Item ==-->
                                            @include('client.components.product-item', ['item' => $item])
                                            <!--== End prPduct Item ==-->
                                        </div>
                                    @endif
                                @endforeach
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

    <!--== Start Divider Area Wrapper ==-->
    <section>
        <div class="container pt--0 pb--0">
            <div class="row flex-md-row-reverse justify-content-between divider-wrap divider-style2">
                <div class="col-lg-6">
                    <div class="divider-thumb-content">
                        <div class="thumb">
                            <a href="shop.html">
                                <img src="{{ asset('theme/client/assets/img/shop/banner/1.webp') }}" width="570"
                                     height="350"
                                     alt="Image-HasTech">
                            </a>
                        </div>
                        <div class="content">
                            <h2 class="title">Sports Shoes</h2>
                            <p class="desc">Up To 30% Off All Shoes & Products</p>
                            <a class="btn-theme" href="shop.html">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="divider-thumb-content">
                        <div class="thumb">
                            <a href="shop.html">
                                <img src="{{ asset('theme/client/assets/img/shop/banner/2.webp') }}" width="570"
                                     height="700"
                                     alt="Image-HasTech">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== End Divider Area Wrapper ==-->

    <!--== Start Blog Area Wrapper ==-->
    <section class="blog-area blog-default-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h3 class="title">Latest Blog</h3>
                        <div class="desc">
                            <p>There are many variations of passages of Lorem Ipsum available</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($posts as $item)
                    @include('client.components.post-item', ['item' => $item])
                @endforeach
            </div>
        </div>
    </section>
    <!--== End Blog Area Wrapper ==-->
@endsection
