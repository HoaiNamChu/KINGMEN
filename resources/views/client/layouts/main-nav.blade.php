<div class="header-area header-default">
    <div class="container">
        <div class="row no-gutter align-items-center position-relative">
            <div class="col-12">
                <div class="header-align">
                    <div class="header-navigation-area position-relative">
                        <ul class="main-menu nav">
                            <li><a href="{{ route('home') }}"><span>Home</span></a></li>
                            <li class="{{ !empty($categories) ? 'has-submenu position-static' : '' }} "><a href="{{ route('shop') }}"><span>Shop</span></a>
                                @if(!empty($categories))
                                    <ul class="submenu-nav">
                                        @foreach($categories as $item)
                                            @include('client.layouts.components.main-nav-category', ['item' => $item])
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                            <li><a href="{{ route('about') }}"><span>About</span></a></li>
                            <li><a href="{{ route('blog') }}"><span>Blog</span></a></li>
                            <li><a href="{{ route('contact') }}"><span>Contact</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
