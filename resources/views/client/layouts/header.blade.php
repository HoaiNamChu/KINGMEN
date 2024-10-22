<header class="main-header-wrapper position-relative">
    <div class="header-top">
        <div class="container pt--0 pb--0">
            <div class="row">
                <div class="col-12">
                    <div class="header-top-align">
                        <div class="header-top-align-start">
                            <div class="desc">
                                <p>World Wide Completely Free Returns and Free Shipping</p>
                            </div>
                        </div>
                        <div class="header-top-align-end">
                            <div class="header-info-items">
                                <div class="info-items">
                                    <ul>
                                        <li class="number"><i class="fa fa-phone"></i><a href="tel://0123456789">+00
                                                123 456 789</a></li>
                                        <li class="email"><i class="fa fa-envelope"></i><a
                                                href="mailto://demo@example.com">demo@example.com</a></li>

                                            @if(Auth::check()) 
                                                <li class="account"><i class="fa fa-user"></i><a href="/account">Account : {{ Auth::user()->name }}</a></li>
                                                <li class="account"><a href="/logout" style="color: brown">Logout</a></li>
                                            @else
                                                <li class="account"><i class="fa fa-user"></i><a href="/login">Account</a></li>
                                            @endif                                            

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle">
        <div class="container pt--0 pb--0">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="header-middle-align">
                        <div class="header-middle-align-start">
                            <div class="header-logo-area">
                                <a href="index.html">
                                    <img class="logo-main" src="{{ asset('theme/client/assets/img/logo.webp') }}"
                                         width="131" height="34"
                                         alt="Logo"/>
                                    <img class="logo-light"
                                         src="{{ asset('theme/client/assets/img/logo-light.webp') }}" width="131"
                                         height="34"
                                         alt="Logo"/>
                                </a>
                            </div>
                        </div>
                        <div class="header-middle-align-center">
                            <div class="header-search-area">
                                <form class="header-searchbox">
                                    <input type="search" class="form-control" placeholder="Search">
                                    <button class="btn-submit" type="submit"><i class="pe-7s-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="header-middle-align-end">
                            <div class="header-action-area">
                                <div class="shopping-search">
                                    <button class="shopping-search-btn" type="button" data-bs-toggle="offcanvas"
                                            data-bs-target="#AsideOffcanvasSearch"
                                            aria-controls="AsideOffcanvasSearch"><i class="pe-7s-search icon"></i>
                                    </button>
                                </div>
                                <div class="shopping-wishlist">
                                    <a class="shopping-wishlist-btn" href="shop-wishlist.html">
                                        <i class="pe-7s-like icon"></i>
                                    </a>
                                </div>
                                <div class="shopping-cart">
                                    <button class="shopping-cart-btn" type="button" data-bs-toggle="offcanvas"
                                            data-bs-target="#AsideOffcanvasCart"
                                            aria-controls="offcanvasRightLabel">
                                        <i class="pe-7s-shopbag icon"></i>
                                        <sup class="shop-count">02</sup>
                                    </button>
                                </div>
                                <button class="btn-menu" type="button" data-bs-toggle="offcanvas"
                                        data-bs-target="#AsideOffcanvasMenu" aria-controls="AsideOffcanvasMenu">
                                    <i class="pe-7s-menu"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-area header-default">
        <div class="container">
            <div class="row no-gutter align-items-center position-relative">
                <div class="col-12">
                    <div class="header-align">
                        <div class="header-navigation-area position-relative">
                            <ul class="main-menu nav">
                                <li class="has-submenu"><a href="index.html"><span>Home</span></a>
                                </li>
                                <li><a href="about-us.html"><span>About</span></a></li>
                                <li class="has-submenu"><a href="#/"><span>Pages</span></a>
                                    <ul class="submenu-nav">
                                        <li><a href="account.html"><span>Account</span></a></li>
                                        <li><a href="account-login.html"><span>Login</span></a></li>
                                        <li><a href="account-register.html"><span>Register</span></a></li>
                                        <li><a href="page-not-found.html"><span>Page Not Found</span></a></li>
                                        <li><a href="{{route('tickets.create')}}"><span>Tickets</span></a></li>
                                    </ul>
                                </li>
                                <li class="has-submenu position-static"><a href="shop.html"><span>Shop</span></a>
                                </li>
                                <li><a href="contact.html"><span>Contact</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
