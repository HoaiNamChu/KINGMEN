@extends('client.layouts.main')

@section('content')


<!--wrapper start-->
<div class="wrapper">


  <main class="main-content">

    <!--== Start My Account Wrapper ==-->
    <section class="my-account-area">
      <div class="container pt--0 pb--0">
        <div class="row">
        <div class="col-lg-12">
          <div class="myaccount-page-wrapper">
            <div class="row">
              <div class="col-lg-3 col-md-4">
                <nav>
                  <div class="myaccount-tab-menu nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="dashboad-tab" data-bs-toggle="tab" data-bs-target="#dashboad" type="button" role="tab" aria-controls="dashboad" aria-selected="true">Dashboard</button>
                    <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab" aria-controls="orders" aria-selected="false"> Orders</button>
                    <button class="nav-link" id="download-tab" data-bs-toggle="tab" data-bs-target="#download" type="button" role="tab" aria-controls="download" aria-selected="false">Download</button>
                    <button class="nav-link" id="payment-method-tab" data-bs-toggle="tab" data-bs-target="#payment-method" type="button" role="tab" aria-controls="payment-method" aria-selected="false">Payment Method</button>
                    <button class="nav-link" id="address-edit-tab" data-bs-toggle="tab" data-bs-target="#address-edit" type="button" role="tab" aria-controls="address-edit" aria-selected="false">address</button>
                    <button class="nav-link" id="account-info-tab" data-bs-toggle="tab" data-bs-target="#account-info" type="button" role="tab" aria-controls="account-info" aria-selected="false">Account Details</button>
                    <button class="nav-link" onclick="window.location.href='/logout'" type="button">Logout</button>
                  </div>
                </nav>
              </div>
              <div class="col-lg-9 col-md-8">
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="dashboad" role="tabpanel" aria-labelledby="dashboad-tab">
                    <div class="myaccount-content">
                      <h3>Dashboard</h3>
                      <div class="welcome">
                        <p>Hello, <strong>{{$userData->name}}</strong> (If Not <strong>{{$userData->name}} !</strong><a href="/logout" class="logout"> Logout</a>)</p>
                      </div>
                      <p>From your account dashboard. you can easily check & view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                    <div class="myaccount-content">
                      <h3>Orders</h3>
                      <div class="myaccount-table table-responsive text-center">
                        <table class="table table-bordered">
                          <thead class="thead-light">
                            <tr>
                              <th>Order</th>
                              <th>Date</th>
                              <th>Status</th>
                              <th>Total</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td>Aug 22, 2022</td>
                              <td>Pending</td>
                              <td>$3000</td>
                              <td><a href="shop-cart.html" class="check-btn sqr-btn ">View</a></td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td>July 22, 2022</td>
                              <td>Approved</td>
                              <td>$200</td>
                              <td><a href="shop-cart.html" class="check-btn sqr-btn ">View</a></td>
                            </tr>
                            <tr>
                              <td>3</td>
                              <td>June 12, 2022</td>
                              <td>On Hold</td>
                              <td>$990</td>
                              <td><a href="shop-cart.html" class="check-btn sqr-btn ">View</a></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="download" role="tabpanel" aria-labelledby="download-tab">
                    <div class="myaccount-content">
                      <h3>Downloads</h3>
                      <div class="myaccount-table table-responsive text-center">
                        <table class="table table-bordered">
                          <thead class="thead-light">
                            <tr>
                              <th>Product</th>
                              <th>Date</th>
                              <th>Expire</th>
                              <th>Download</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Haven - Free Real Estate PSD Template</td>
                              <td>Aug 22, 2022</td>
                              <td>Yes</td>
                              <td><a href="#/" class="check-btn sqr-btn"><i class="fa fa-cloud-download"></i> Download File</a></td>
                            </tr>
                            <tr>
                              <td>HasTech - Profolio Business Template</td>
                              <td>Sep 12, 2022</td>
                              <td>Never</td>
                              <td><a href="#/" class="check-btn sqr-btn"><i class="fa fa-cloud-download"></i> Download File</a></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="payment-method" role="tabpanel" aria-labelledby="payment-method-tab">
                    <div class="myaccount-content">
                      <h3>Payment Method</h3>
                      <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                    </div>
                  </div>

                  {{-- Update billing address --}}
                  <div class="tab-pane fade" id="address-edit" role="tabpanel" aria-labelledby="address-edit-tab">
                    <div class="myaccount-content">
                      
                      @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                      @endif
                      
                      @if($errors->any())
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif
                  
                        <h3>Billing Address</h3>
                        @if(Auth::check())
                        <form action="/update-billing-address" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $userData->name }}">
                            </div>
                
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ $userData->address }}">
                            </div>
                
                            <div class="form-group">
                                <label for="phone">Mobile:</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $userData->phone }}"><hr>
                            </div>
                
                            <button type="submit" class="btn btn-success" style="background-color: #eb3e32; border-color: #eb3e32;">Update</button>
                        </form>
                        @else
                        <p>Bạn cần đăng nhập để xem thông tin tài khoản.</p>
                        @endif
                    </div>
                  </div>
                  {{--  --}}

                  {{-- ACCOUNT detail --}}
                  <div class="tab-pane fade" id="account-info" role="tabpanel" aria-labelledby="account-info-tab">
                    <div class="myaccount-content">
                      <h3>Account Details</h3>
                      <div class="account-details-form">

                        <form action="#">
                          @if(Auth::check()) <!-- Kiểm tra nếu người dùng đã đăng nhập -->
                              <div class="single-input-item">
                                  <label for="display-name" class="required">Display Name</label>
                                  <input type="text" id="display-name" value="{{ Auth::user()->name }}" readonly /> <!-- Hiển thị tên hiển thị -->
                              </div>
                      
                              <div class="single-input-item">
                                  <label for="email" class="required">Email Address</label>
                                  <input type="email" id="email" value="{{ Auth::user()->email }}" readonly /> <!-- Hiển thị email người dùng -->
                              </div>
                      
                              @php
                                  // Kiểm tra người dùng đã đăng nhập bằng Google hay không
                                  $finduser = Auth::user();
                              @endphp
                      
                              @if(!empty($finduser->google_id)) <!-- Kiểm tra nếu người dùng đăng nhập bằng Google -->
                                <div class="text-center">
                                  <div class="col-md-12">
                                    <img src="https://img.icons8.com/color/16/000000/google-logo.png"> Google account
                                  </div>
                                </div>
                              @else
                                  <form action="#" method="POST">
                                    @csrf
                                    <fieldset>
                                        <legend>you forgot your password ?</legend>
                                    </fieldset>
                                    <div class="single-input-item">
                                      <button class="check-btn sqr-btn">Save Changes</button>
                                    </div>
                                  </form>
                              @endif
                      
                              
                          @else
                              <p>Bạn cần đăng nhập để xem thông tin tài khoản.</p> <!-- Thông báo nếu chưa đăng nhập -->
                          @endif
                      </form>
                      
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>
    <!--== End My Account Wrapper ==-->
  </main>

  <!--== Scroll Top Button ==-->
  <div id="scroll-to-top" class="scroll-to-top"><span class="fa fa-angle-up"></span></div>

  <!--== Start Quick View Menu ==-->
  <aside class="product-quick-view-modal">
    <div class="product-quick-view-inner">
      <div class="product-quick-view-content">
        <button type="button" class="btn-close">
          <span class="close-icon"><i class="fa fa-close"></i></span>
        </button>
        <div class="row align-items-center">
          <div class="col-lg-6 col-md-6 col-12">
            <div class="thumb">
              <img src="assets/img/shop/product-single/1.webp" width="570" height="541" alt="Alan-Shop">
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-12">
            <div class="content">
              <h4 class="title">Space X Bag For Office</h4>
              <div class="prices">
                <del class="price-old">$85.00</del>
                <span class="price">$70.00</span>
              </div>
              <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia,</p>
              <div class="quick-view-select">
                <div class="quick-view-select-item">
                  <label for="forSize" class="form-label">Size:</label>
                  <select class="form-select" id="forSize" required>
                    <option selected value="">s</option>
                    <option>m</option>
                    <option>l</option>
                    <option>xl</option>
                  </select>
                </div>
                <div class="quick-view-select-item">
                  <label for="forColor" class="form-label">Color:</label>
                  <select class="form-select" id="forColor" required>
                    <option selected value="">red</option>
                    <option>green</option>
                    <option>blue</option>
                    <option>yellow</option>
                    <option>white</option>
                  </select>
                </div>
              </div>
              <div class="action-top">
                <div class="pro-qty">
                  <input type="text" id="quantity20" title="Quantity" value="1" />
                </div>
                <button class="btn btn-black">Add to cart</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="canvas-overlay"></div>
  </aside>
  <!--== End Quick View Menu ==-->

  <!--== Start Aside Cart Menu ==-->
  <div class="aside-cart-wrapper offcanvas offcanvas-end" tabindex="-1" id="AsideOffcanvasCart" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
      <h1 id="offcanvasRightLabel"></h1>
      <button class="btn-aside-cart-close" data-bs-dismiss="offcanvas" aria-label="Close">Shopping Cart <i class="fa fa-chevron-right"></i></button>
    </div>
    <div class="offcanvas-body">
      <ul class="aside-cart-product-list">
        <li class="product-list-item">
          <a href="#/" class="remove">×</a>
          <a href="single-product.html">
            <img src="assets/img/shop/product-mini/1.webp" width="90" height="110" alt="Image-HasTech">
            <span class="product-title">Leather Mens Slipper</span>
          </a>
          <span class="product-price">1 × £69.99</span>
        </li>
        <li class="product-list-item">
          <a href="#/" class="remove">×</a>
          <a href="single-product.html">
            <img src="assets/img/shop/product-mini/2.webp" width="90" height="110" alt="Image-HasTech">
            <span class="product-title">Quickiin Mens shoes</span>
          </a>
          <span class="product-price">1 × £20.00</span>
        </li>
      </ul>
      <p class="cart-total"><span>Subtotal:</span><span class="amount">£89.99</span></p>
      <a class="btn-theme" data-margin-bottom="10" href="shop-cart.html">View cart</a>
      <a class="btn-theme" href="shop-checkout.html">Checkout</a>
      <a class="d-block text-end lh-1" href="shop-checkout.html"><img src="assets/img/photos/paypal.webp" width="133" height="26" alt="Has-image"></a>
    </div>
  </div>
  <!--== End Aside Cart Menu ==-->

  <!--== Start Aside Search Menu ==-->
  <aside class="aside-search-box-wrapper offcanvas offcanvas-top" tabindex="-1" id="AsideOffcanvasSearch" aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-header">
      <h5 class="d-none" id="offcanvasTopLabel">Aside Search</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="pe-7s-close"></i></button>
    </div>
    <div class="offcanvas-body">
      <div class="container pt--0 pb--0">
        <div class="search-box-form-wrap">
          <div class="search-note">
            <p>Start typing and press Enter to search</p>
          </div>
          <form action="#" method="post">
            <div class="search-form position-relative">
              <label for="search-input" class="visually-hidden">Search</label>
              <input id="search-input" type="search" class="form-control" placeholder="Search entire store…">
              <button class="search-button"><i class="fa fa-search"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </aside>
  <!--== End Aside Search Menu ==-->

  <!--== Start Side Menu ==-->
  <div class="off-canvas-wrapper offcanvas offcanvas-start" tabindex="-1" id="AsideOffcanvasMenu" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h1 id="offcanvasExampleLabel"></h1>
      <button class="btn-menu-close" data-bs-dismiss="offcanvas" aria-label="Close">menu <i class="fa fa-chevron-left"></i></button>
    </div>
    <div class="offcanvas-body">
      <div class="info-items">
        <ul>
          <li class="number"><a href="tel://0123456789"><i class="fa fa-phone"></i>+00 123 456 789</a></li>
          <li class="email"><a href="mailto://demo@example.com"><i class="fa fa-envelope"></i>demo@example.com</a></li>
          <li class="account"><a href="account-login.html"><i class="fa fa-user"></i>Account</a></li>
        </ul>
      </div>
      <!-- Mobile Menu Start -->
      <div class="mobile-menu-items">
        <ul class="nav-menu">
          <li><a href="#">Home</a>
            <ul class="sub-menu">
              <li><a href="index.html">Home One</a></li>
              <li><a href="index-two.html">Home Two</a></li>
            </ul>
          </li>
          <li><a href="about-us.html">About</a></li>
          <li><a href="#">Pages</a>
            <ul class="sub-menu">
              <li><a href="account.html">Account</a></li>
              <li><a href="account-login.html">Login</a></li>
              <li><a href="account-register.html">Register</a></li>
              <li><a href="page-not-found.html">Page Not Found</a></li>
            </ul>
          </li>
          <li><a href="#">Shop</a>
            <ul class="sub-menu">
              <li><a href="#">Shop Layout</a>
                <ul class="sub-menu">
                  <li><a href="shop-three-columns.html">Shop 3 Column</a></li>
                  <li><a href="shop-four-columns.html">Shop 4 Column</a></li>
                  <li><a href="shop.html">Shop Left Sidebar</a></li>
                  <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                </ul>
              </li>
              <li><a href="#">Single Product</a>
                <ul class="sub-menu">
                  <li><a href="single-normal-product.html">Single Product Normal</a></li>
                  <li><a href="single-product.html">Single Product Variable</a></li>
                  <li><a href="single-group-product.html">Single Product Group</a></li>
                  <li><a href="single-affiliate-product.html">Single Product Affiliate</a></li>
                </ul>
              </li>
              <li><a href="#">Others Pages</a>
                <ul class="sub-menu">
                  <li><a href="shop-cart.html">Shopping Cart</a></li>
                  <li><a href="shop-checkout.html">Checkout</a></li>
                  <li><a href="shop-wishlist.html">Wishlist</a></li>
                  <li><a href="shop-compare.html">Compare</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="#">Blog</a>
            <ul class="sub-menu">
              <li><a href="#">Blog Layout</a>
                <ul class="sub-menu">
                  <li><a href="blog.html">Blog Grid</a></li>
                  <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                  <li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
                </ul>
              </li>
              <li><a href="#">Single Blog</a>
                <ul class="sub-menu">
                  <li><a href="blog-details-no-sidebar.html">Blog Details</a></li>
                  <li><a href="blog-details-left-sidebar.html">Blog Details Left Sidebar</a></li>
                  <li><a href="blog-details.html">Blog Details Right Sidebar</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
      </div>
      <!-- Mobile Menu End -->
    </div>
  </div>
  <!--== End Side Menu ==-->
</div>

@endsection