@extends('client.layouts.main')

@section('content')
    <!--== Start Page Header Area Wrapper ==-->
    <div class="page-header-area" data-bg-img="{{ asset('theme/client/assets/img/photos/bg3.webp') }}">
        <div class="container pt--0 pb--0">
            <div class="row">
                <div class="col-12">
                    <div class="page-header-content">
                        <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Product Page</h2>
                        <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
                            <ul class="breadcrumb">
                                <li><a href="index.html">Home</a></li>
                                <li class="breadcrumb-sep">//</li>
                                <li>Product Page</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--== End Page Header Area Wrapper ==-->

    <!--== Start Product Area Wrapper ==-->
    <section class="product-area product-default-area">
        <div class="container">
            <div class="row flex-xl-row-reverse justify-content-between">
                <div class="col-xl-9">
                    <div class="row">
                        <div class="col-12">
                            <div class="shop-top-bar">
                                <div class="shop-top-left">
                                    <p class="pagination-line"><a href="shop.html">12</a> Product Found of <a
                                            href="shop.html">30</a></p>
                                </div>

                                <div class="shop-top-right">
                                    <div class="shop-sort">
                                        <span>Sort By :</span>
                                        <select class="form-select" aria-label="Sort select example">
                                            <option selected>Default</option>
                                            <option value="1">Popularity</option>
                                            <option value="2">Average Rating</option>
                                            <option value="3">Newsness</option>
                                            <option value="4">Price Low to High</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-grid" role="tabpanel"
                                     aria-labelledby="nav-grid-tab">
                                    <div class="row">
                                        @if(!empty($products))
                                            @foreach($products as $item)
                                                <div class="col-sm-6 col-lg-4">
                                                    <!--== Start Product Item ==-->
                                                    @include('client.components.product-item', ['item' => $item])
                                                    <!--== End prPduct Item ==-->
                                                </div>
                                            @endforeach
                                        @endif
                                        <div class="col-12">
                                            <div class="pagination-items">
                                                <ul class="pagination justify-content-end mb--0">
                                                    @if($products->count())
                                                        @foreach($products->links()->elements[0] as $key => $value)
                                                            <li><a class="active" href="{{ $value }}">{{ $key }}</a>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                    {{--                                                    <li><a class="active" href="shop.html">1</a></li>--}}
                                                    {{--                                                    <li><a href="shop-four-columns.html">2</a></li>--}}
                                                    {{--                                                    <li><a href="shop-three-columns.html">3</a></li>--}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3">
                    <div class="shop-sidebar">
                        @if($categories)
                            <div class="shop-sidebar-category">
                                <h4 class="sidebar-title">Top Categories</h4>
                                <div class="sidebar-category">
                                    <ul class="category-list mb--0">
                                        @foreach($categories as $item)
                                            <li><a href="{{ route('category.filter', $item->slug) }}">{{ $item->name }}
                                                    <span>({{ $item->products_count }})</span></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        @if($brands)
                            <div class="shop-sidebar-brand">
                                <h4 class="sidebar-title">Brand</h4>
                                <div class="sidebar-brand">
                                    <ul class="brand-list mb--0">
                                        @foreach($brands as $item)
                                            <li><a href="{{ route('brand.filter', $item->slug) }}">{{ $item->name }}
                                                    <span>({{ $item->products_count }})</span></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <div class="shop-sidebar-price-range">
                            <h4 class="sidebar-title">Price Filter</h4>
                            <div class="sidebar-price-range">
                                <div id="price-range"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== End Product Area Wrapper ==-->
@endsection
