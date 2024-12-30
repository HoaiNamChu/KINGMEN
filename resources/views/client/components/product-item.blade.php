<div class="product-item">
    <div class="inner-content">
        <div class="product-thumb">
            <a href="{{ route('product.detail', $item->slug) }}" style="width: 100%; height: 100%">
                <img src="{{ Storage::url($item->image) }}" width="270" height="274" alt="Image-HasTech">
            </a>
            @if($item->is_sale)
                <div class="product-flag">
                    <ul>
                        <li class="discount">Sale</li>
                    </ul>
                </div>
            @endif
            <div class="product-action">


                <button type="button" class="btn-product-wishlist" data-route="{{ route('wishlist.store') }}" data-product-id="{{ $item->id }}"><i class="fa fa-heart"></i></button>
{{--                <a class="btn-product-cart" href="shop-cart.html"><i class="fa fa-shopping-cart"></i></a>--}}
{{--                <button type="button" data-route="{{ route('product.show', $item->id) }}" class="btn-product-quick-view-open">--}}
{{--                    <i class="fa fa-arrows"></i>--}}
{{--                </button>--}}
{{--                <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a>--}}
            </div>
            <a class="banner-link-overlay" href="shop.html"></a>
        </div>
        <div class="product-info">
            @if($item->categories->count())
                <div class="category">
                    <ul>
                        @foreach($item->categories as $cate)
                            <li><a href="{{ $cate->slug }}">{{ $cate->name }}</a></li>
                            <li class="sep">/</li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="category">
                    <ul>
                        <li>{{ 'No Category' }}</li>
                    </ul>
                </div>
            @endif
            <h4 class="title"><a href="{{ route('product.detail', $item->slug) }}">{{ $item->name }}</a></h4>
            <div class="prices">
                @if($item->variants->count())
                    <span class="price">{{ number_format($item->price_sale) }} VND</span>
                    <span class="sep">-</span>
                    <span class="price">{{ number_format($item->price) }} VND</span>
                @else
                    @if($item->is_sale && $item->price_sale)
                        <span class="price-old">{{ number_format($item->price) }} VND</span>
                        <span class="sep">-</span>
                        <span class="price">{{ number_format($item->price_sale) }} VND</span>
                    @else
                        <span class="price">{{ number_format($item->price) }} VND</span>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
