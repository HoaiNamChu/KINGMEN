<div class="product-item">
    <div class="inner-content">
        <div class="product-thumb">
            <a href="{{ route('product.detail', $item->slug) }}" style="width: 100%; height: 100%">
                <img src="{{ Storage::url($item->image) }}" width="270"
                     height="274" alt="Image-HasTech">
            </a>
            <div class="product-flag">
                <ul>
                    <li class="discount">-10%</li>
                </ul>
            </div>
            <div class="product-action">
                <a class="btn-product-wishlist" href="shop-wishlist.html"><i
                        class="fa fa-heart"></i></a>
                <a class="btn-product-cart" href="shop-cart.html"><i
                        class="fa fa-shopping-cart"></i></a>
                <button type="button" class="btn-product-quick-view-open">
                    <i class="fa fa-arrows"></i>
                </button>
                <a class="btn-product-compare" href="shop-compare.html"><i
                        class="fa fa-random"></i></a>
            </div>
            <a class="banner-link-overlay" href="shop.html"></a>
        </div>
        <div class="product-info">
            @if($item->categories->count())
                <div class="category">
                    <ul>
                        @foreach($item->categories as $cate)
                            <li><a href="shop.html">{{ $cate->name }}</a></li>
                            <li class="sep">/</li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="category">
                    <ul>
                        <li><a href="shop.html">{{ 'No brand' }}</a></li>
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
