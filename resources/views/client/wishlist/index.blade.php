@extends('client.layouts.main')

@section('content')

<div class="page-header-area" data-bg-img="assets/img/photos/bg3.webp">
  <div class="container pt--0 pb--0">
    <div class="row">
      <div class="col-12">
        <div class="page-header-content">
          <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Wishlist</h2>
          <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
            <ul class="breadcrumb">
              <li><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-sep">//</li>
              <li>Wishlist</li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

<!--== Start Wishlist Area Wrapper ==-->
<section class="shopping-wishlist-area">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="shopping-wishlist-table table-responsive">
          <table class="table text-center">
            <thead>
              <tr>
                <th class="product-remove">&nbsp;</th>
                <th class="product-thumb">&nbsp;</th>
                <th class="product-name">Product</th>
                <th class="product-stock-status">Stock Status</th>
                <th class="product-price">Price</th>
                <th class="product-action">&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($wishlists as $wishlist)

          <tr class="cart-wishlist-item">
          <script>
            function confirmDelete() {
            return confirm("Bạn có chắc chắn muốn xóa sản phẩm này khỏi wishlist?");
            }
          </script>
          <td class="product-remove">
            <form action="{{route('wishlist.destroy', $wishlist)}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirmDelete()" ><i class="fa fa-trash-o"></i></button>
            </form>
          </td>
          <td class="product-thumb">
            <a href="{{route('product.detail', $wishlist->product->slug)}}">
            <img src="{{ Storage::url($wishlist->product->image) }}" width="90" height="110" alt="">
            </a>
          </td>
          <td class="product-name">
            <h4 class="title"><a
              href="{{route('product.detail', $wishlist->product->slug)}}">{{$wishlist->product->name}}</a></h4>
          </td>
          <td class="product-stock-status">
            @if($wishlist->product->quantity > 5)
        <span class="stock">In Stock</span>
      @else
    <span class="out-of-stock">Out of Stock</span>
  @endif
          </td>
          <td class="product-price">
            <span class="price">{{$wishlist->product->price}}</span>
          </td>
          <td class="product-action">
            <a class="btn-cart" href="{{route('product.detail', $wishlist->product->slug)}}">Shop Now</a>
          </td>
          </tr>

        @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<!--== End Wishlist Area Wrapper ==-->

@endsection
