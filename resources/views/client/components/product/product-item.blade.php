
    <!--== Start Product Item ==-->
    <div class="product-item">
        <div class="inner-content">
            <div class="product-thumb">
                <a href="{{ route('product.detail', $item->slug) }}">
                    <img src="{{ Storage::url($item->image) }}"
                         width="270"
                         height="274" alt="Image-HasTech">
                </a>
                <div class="product-flag">
                    <ul>
                        <li class="discount">-10%</li>
                    </ul>
                </div>
                <div class="product-action">
                    <a class="btn-product-wishlist"
                       href="shop-wishlist.html"><i class="fa fa-heart"></i></a>
                    <a class="btn-product-cart" href="shop-cart.html"><i
                            class="fa fa-shopping-cart"></i></a>
                    <button type="button"
                            class="btn-product-quick-view-open">
                        <i class="fa fa-arrows"></i>
                    </button>
                    <a class="btn-product-compare" href="shop-compare.html"><i
                            class="fa fa-random"></i></a>
                </div>
                <a class="banner-link-overlay" href="shop.html"></a>
            </div>
            <div class="product-info">
                <div class="category">
                    <ul>
                        @if($item->categories->count())
                            @foreach($item->categories as $category)
                                <li><a href="shop.html">{{ $category->name }}</a></li>
                                <li class="sep">/</li>
                            @endforeach
                        @else
                            <li>No category</li>
                        @endif
                    </ul>
                </div>
                <h4 class="title"><a href="{{ route('product.detail', $item->slug) }}">{{ $item->name }}</a></h4>
                <div class="prices">
                    @if($item->price_sale > 0)
                        <span class="price-old">${{ number_format($item->price) }}</span>
                        <span class="sep">-</span>
                        <span class="price">${{ number_format($item->price_sale) }}</span>
                    @else
                        <li>No category</li>
                    @endif
                </ul>
            </div>
            <h4 class="title"><a href="single-product.html">{{ $item->name }}</a></h4>
            <div class="prices">
                @if ($item->price_sale > 0)
                    <span class="price-old">${{ number_format($item->price) }}</span>
                    <span class="sep">-</span>
                    <span class="price">${{ number_format($item->price_sale) }}</span>
                @else
                    <span class="price">${{ number_format($item->price) }}</span>
                @endif
            </div>
        </div>
    </div>
</div>
<!--== End prPduct Item ==-->