<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from template.hasthemes.com/shome/shome/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Feb 2024 15:05:17 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Shome - Shoes eCommerce Website Template"/>
    <meta name="keywords" content="footwear, shoes, modern, shop, store, ecommerce, responsive, e-commerce"/>
    <meta name="author" content="codecarnival"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Shome - Shoes eCommerce Website Template</title>

    <!--== Favicon ==-->
    <link rel="shortcut icon" href="{{ asset('theme/client/assets/img/favicon.ico') }}" type="image/x-icon"/>

    <!--== Google Fonts ==-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,600;0,700;0,800;1,400;1,500&amp;display=swap"
        rel="stylesheet">

    <!--== Bootstrap CSS ==-->
    <link href="{{ asset('theme/client/assets/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <!--== Font Awesome Min Icon CSS ==-->
    <link href="{{ asset('theme/client/assets/css/font-awesome.min.css') }}" rel="stylesheet"/>
    <!--== Pe7 Stroke Icon CSS ==-->
    <link href="{{ asset('theme/client/assets/css/pe-icon-7-stroke.css') }}" rel="stylesheet"/>
    <!--== Swiper CSS ==-->
    <link href="{{ asset('theme/client/assets/css/swiper.min.css') }}" rel="stylesheet"/>
    <!--== Fancybox Min CSS ==-->
    <link href="{{ asset('theme/client/assets/css/fancybox.min.css') }}" rel="stylesheet"/>
    <!--== Aos Min CSS ==-->
    <link href="{{ asset('theme/client/assets/css/aos.min.css') }}" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    @yield('links')
    <!--== Main Style CSS ==-->
    <link href="{{ asset('theme/client/assets/css/style.css') }}" rel="stylesheet"/>



    @yield('styles')

    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!--wrapper start-->
<div class="wrapper">

    <!--== Start Header Wrapper ==-->
    @include('client.layouts.header')
    <!--== End Header Wrapper ==-->

    <main class="main-content">
        @yield('content')
    </main>

    <!--== Start Footer Area Wrapper ==-->
    @include('client.layouts.footer')
    <!--== End Footer Area Wrapper ==-->

    {{--    Chat box area--}}

    @include('client.layouts.components.chat-box')

    {{--    Chat box area--}}

    <!--== Scroll Top Button ==-->
    <div id="scroll-to-top" class="scroll-to-top"><span class="fa fa-angle-up"></span></div>

    <!--== Start Quick View Menu ==-->
{{--    @include('client.layouts.product-quick-view-modal')--}}
    <!--== End Quick View Menu ==-->

    <!--== Start Aside Cart Menu ==-->
{{--    @include('client.layouts.aside-cart-menu')--}}
    <!--== End Aside Cart Menu ==-->

    <!--== Start Aside Search Menu ==-->
    <aside class="aside-search-box-wrapper offcanvas offcanvas-top" tabindex="-1" id="AsideOffcanvasSearch"
           aria-labelledby="offcanvasTopLabel">
        <div class="offcanvas-header">
            <h5 class="d-none" id="offcanvasTopLabel">Aside Search</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i
                    class="pe-7s-close"></i></button>
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
                            <input id="search-input" type="search" class="form-control"
                                   placeholder="Search entire store…">
                            <button class="search-button"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </aside>
    <!--== End Aside Search Menu ==-->

    <!--== Start Side Menu ==-->
    <div class="off-canvas-wrapper offcanvas offcanvas-start" tabindex="-1" id="AsideOffcanvasMenu"
         aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h1 id="offcanvasExampleLabel"></h1>
            <button class="btn-menu-close" data-bs-dismiss="offcanvas" aria-label="Close">menu <i
                    class="fa fa-chevron-left"></i></button>
        </div>
        <div class="offcanvas-body">
            <div class="info-items">
                <ul>
                    <li class="number"><a href="tel://0123456789"><i class="fa fa-phone"></i>+00 123 456 789</a></li>
                    <li class="email"><a href="mailto://demo@example.com"><i class="fa fa-envelope"></i>demo@example.com</a>
                    </li>
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

<!--=======================Javascript============================-->

<!--=== jQuery Modernizr Min Js ===-->
<script src="{{ asset('theme/client/assets/js/modernizr.js') }}"></script>
<!--=== jQuery Min Js ===-->
<script src="{{ asset('theme/client/assets/js/jquery-main.js') }}"></script>
<!--=== jQuery Migration Min Js ===-->
<script src="{{ asset('theme/client/assets/js/jquery-migrate.js') }}"></script>
<!--=== jQuery Popper Min Js ===-->
<script src="{{ asset('theme/client/assets/js/popper.min.js') }}"></script>
<!--=== jQuery Bootstrap Min Js ===-->
<script src="{{ asset('theme/client/assets/js/bootstrap.min.js') }}"></script>
<!--=== jQuery Ui Min Js ===-->
<script src="{{ asset('theme/client/assets/js/jquery-ui.min.js') }}"></script>
<!--=== jQuery Swiper Min Js ===-->
<script src="{{ asset('theme/client/assets/js/swiper.min.js') }}"></script>
<!--=== jQuery Fancybox Min Js ===-->
<script src="{{ asset('theme/client/assets/js/fancybox.min.js') }}"></script>
<!--=== jQuery Waypoint Js ===-->
<script src="{{ asset('theme/client/assets/js/waypoint.js') }}"></script>
<!--=== jQuery Parallax Min Js ===-->
<script src="{{ asset('theme/client/assets/js/parallax.min.js') }}"></script>
<!--=== jQuery Aos Min Js ===-->
<script src="{{ asset('theme/client/assets/js/aos.min.js') }}"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script src="{{ asset('theme/client/assets/js/custom.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

@yield('lib-script')
<!--=== jQuery Custom Js ===-->


@vite('resources/js/app.js')

@yield('scripts')

<script>
    @if(session('success'))
    Toastify({

        text: "{{ session('success') }}",

        duration: 3000,

        gravity: top,

        close: true,

        style: {background: 'green'},

    }).showToast();
    @endif

    @if(session('error'))
    Toastify({

        text: "{{ session('error') }}",

        duration: 3000,

        gravity: top,

        close: true,

        style: {background: 'red'},

    }).showToast();
    @endif
</script>

<script type="module">
    let chatRoomId;

    async function fetchData() {


        const response = await axios.get('{{ route('chat.index') }}');

        chatRoomId = response.data.chat_room.id;

        Echo.private(`chat-support-${chatRoomId}`)
            .listen('SendMessage', e => {
                if ('{{ request()->cookie('guest_id') }}' == e.senderId) {

                } else {
                    $('.chat-box-list').append(createHTMLMessageFromOther(e.message.message));

                }
            });
    }

    fetchData();


    $('.btn-send').click(function () {
        let message = $('.message').val();
        axios.post('{{ route('chat.store') }}', {
            'message': message
        })
            .then((data) => {
                // console.log(data)
                $('.chat-box-list').append(createHTMLMessageFromMe(data.data.message.message));
                $('.message').val('');
            })
    });

    function createHTMLMessageFromMe(message) {
        const today = new Date();
        const time = today.getHours() + ":" + today.getMinutes() + " " + (today.getHours() > 11 ? "pm" : "am");
        return '<li class="clearfix odd">\n' + '    <div class="chat-conversation-text ms-0">\n' + '        <div class="d-flex justify-content-end">\n' + '            <div class="chat-ctext-wrap">\n' + '                <p>' + message + '</p>\n' + '            </div>\n' + '        </div>\n' + '        <p class="text-muted fs-12 mb-0 mt-1 d-flex justify-content-end">' + time + '<i class="bx bx-check-double ms-1 text-primary"></i></p>\n' + '    </div>\n' + '</li>\n';
    }

    function createHTMLMessageFromOther(message) {
        const today = new Date();
        const time = today.getHours() + ":" + today.getMinutes() + " " + (today.getHours() > 11 ? "pm" : "am");
        return '<li class="clearfix">\n' + '    <div class="chat-conversation-text">\n' + '        <div class="d-flex">\n' + '            <div class="chat-ctext-wrap">\n' + '                <p>' + message + '</p>\n' + '            </div>\n' + '        </div>\n' + '        <p class="text-muted fs-12 mb-0 mt-1 ms-2">' + time + '</p>\n' + '    </div>\n' + '</li>';
    }


</script>

</body>


<!-- Mirrored from template.hasthemes.com/shome/shome/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Feb 2024 15:05:41 GMT -->
</html>

