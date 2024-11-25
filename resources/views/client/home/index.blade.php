@extends('client.layouts.main')

@section('content')
    <!--== Start Hero Area Wrapper ==-->
    <section class="home-slider-area">
        <div class="swiper-container home-slider-container default-slider-container">
            <div class="swiper-wrapper home-slider-wrapper slider-default">
                <div class="swiper-slide">
                    <div class="slider-content-area"
                         data-bg-img="{{ asset('theme/client/assets/img/shape/1.webp') }}">
                        <div class="container">
                            <div class="slider-container">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-sm-6 col-md-5">
                                        <div class="slider-content">
                                            <div class="content">
                                                <div class="title-box">
                                                    <h2 class="title">Exclusive New Shoes</h2>
                                                </div>
                                                <div class="desc-box">
                                                    <p class="desc">Up To 30% Off All Shoes & Products</p>
                                                </div>
                                                <div class="btn-box">
                                                    <a class="btn-slider" href="shop.html">Shop Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="slider-thumb">
                                            <div class="thumb scene">
                                                    <span class="scene-layer" data-depth=".3"><img
                                                            src="{{ asset('theme/client/assets/img/slider/slider-01.webp') }}"
                                                            width="461"
                                                            height="489" alt="Image-HasTech"></span>
                                            </div>
                                            <div class="shape-group mousemove">
                                                <div class="shape-group-one mousemove-layer" data-speed=".8"
                                                     data-bg-img="{{ asset('theme/client/assets/img/shape/2.webp') }}"></div>
                                                <div class="shape-group-two scene"><span class="scene-layer"
                                                                                         data-depth=".6"><img
                                                            src="{{ asset('theme/client/assets/img/shape/3.webp') }}"
                                                            width="471" height="462"
                                                            alt="Image-HasTech"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h2 class="slider-text-shape">NEW 2021</h2>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="slider-content-area"
                         data-bg-img="{{ asset('theme/client/assets/img/shape/1.webp') }}">
                        <div class="container">
                            <div class="slider-container">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-sm-6 col-md-5">
                                        <div class="slider-content">
                                            <div class="content">
                                                <div class="title-box">
                                                    <h2 class="title">Exclusive New Shoes</h2>
                                                </div>
                                                <div class="desc-box">
                                                    <p class="desc">Up To 30% Off All Shoes & Products</p>
                                                </div>
                                                <div class="btn-box">
                                                    <a class="btn-slider" href="shop.html">Shop Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="slider-thumb">
                                            <div class="thumb scene">
                                                    <span class="scene-layer" data-depth=".3"><img
                                                            src="{{ asset('theme/client/assets/img/slider/slider-03.webp') }}"
                                                            width="548"
                                                            height="649" alt="Image-HasTech"></span>
                                            </div>
                                            <div class="shape-group mousemove">
                                                <div class="shape-group-one mousemove-layer" data-speed=".8"
                                                     data-bg-img="{{ asset('theme/client/assets/img/shape/2.webp') }}"></div>
                                                <div class="shape-group-two scene"><span class="scene-layer"
                                                                                         data-depth=".6"><img
                                                            src="{{ asset('theme/client/assets/img/shape/3.webp') }}"
                                                            width="471" height="462"
                                                            alt="Image-HasTech"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h2 class="slider-text-shape">NEW 2022</h2>
                    </div>
                </div>
            </div>

            <!--== Add Swiper Arrows ==-->
            <div class="swiper-btn-wrap">
                <div class="swiper-btn-prev">
                    <i class="pe-7s-angle-left"></i>
                </div>
                <div class="swiper-btn-next">
                    <i class="pe-7s-angle-right"></i>
                </div>
            </div>
        </div>
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
                <div class="col-md-6 col-lg-4">
                    <!--== Start Blog Item ==-->
                    <div class="post-item">
                        <div class="inner-content">
                            <div class="thumb">
                                <a href="blog-details.html"><img
                                        src="{{ asset('theme/client/assets/img/blog/1.webp') }}" width="370"
                                        height="260" alt="Image-HasTech"></a>
                            </div>
                            <div class="content">
                                <div class="meta-post">
                                    <ul>
                                        <li class="post-date"><i class="fa fa-calendar"></i><a href="blog.html">27,Jun
                                                2030</a></li>
                                        <li class="author-info"><i class="fa fa-user"></i><a href="blog.html">Oaklee
                                                Odom</a></li>
                                    </ul>
                                </div>
                                <h4 class="title"><a href="blog-details.html">Lorem ipsum dolor ametcons adipisicing
                                        elit sed</a></h4>
                                <a class="post-btn" href="blog.html">Read More</a>
                            </div>
                        </div>
                    </div>
                    <!--== End Blog Item ==-->
                </div>
                <div class="col-md-6 col-lg-4">
                    <!--== Start Blog Item ==-->
                    <div class="post-item">
                        <div class="inner-content">
                            <div class="thumb">
                                <a href="blog-details.html"><img
                                        src="{{ asset('theme/client/assets/img/blog/2.webp') }}" width="370"
                                        height="260" alt="Image-HasTech"></a>
                            </div>
                            <div class="content">
                                <div class="meta-post">
                                    <ul>
                                        <li class="post-date"><i class="fa fa-calendar"></i><a href="blog.html">27,Jun
                                                2030</a></li>
                                        <li class="author-info"><i class="fa fa-user"></i><a href="blog.html">Oaklee
                                                Odom</a></li>
                                    </ul>
                                </div>
                                <h4 class="title"><a href="blog-details.html">Celebrity Daughter Opens About Upto
                                        Having Her Eye</a></h4>
                                <a class="post-btn" href="blog.html">Read More</a>
                            </div>
                        </div>
                    </div>
                    <!--== End Blog Item ==-->
                </div>
                <div class="col-md-6 col-lg-4">
                    <!--== Start Blog Item ==-->
                    <div class="post-item">
                        <div class="inner-content">
                            <div class="thumb">
                                <a href="blog-details.html"><img
                                        src="{{ asset('theme/client/assets/img/blog/3.webp') }}" width="370"
                                        height="260" alt="Image-HasTech"></a>
                            </div>
                            <div class="content">
                                <div class="meta-post">
                                    <ul>
                                        <li class="post-date"><i class="fa fa-calendar"></i><a href="blog.html">27,Jun
                                                2030</a></li>
                                        <li class="author-info"><i class="fa fa-user"></i><a href="blog.html">Oaklee
                                                Odom</a></li>
                                    </ul>
                                </div>
                                <h4 class="title"><a href="blog-details.html">Romantic Love Stories Of Hollywood
                                        Popular Celebrities</a></h4>
                                <a class="post-btn" href="blog.html">Read More</a>
                            </div>
                        </div>
                    </div>
                    <!--== End Blog Item ==-->
                </div>
            </div>
        </div>
    </section>
    <!--== End Blog Area Wrapper ==-->
@endsection
