<header>
    <div class="container-fluid">
        <div class="header-large-device">
            <div class="header-bottom">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo">
                            <a href="{{route('index')}}"><img height="100" src="{{ asset('/images/logo/logo.png') }}" alt="logo"></a>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7">
                        <div class="main-menu main-menu-padding-1 main-menu-lh-1 text-center">
                            <nav>
                                <ul>
                                    <li>
                                        <a href="{{route('index')}}">HOME</a>
                                    </li>
                                    <li>
                                        <a href="{{route('shop')}}">SHOP</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3">
                        <div class="header-action header-action-flex header-action-mrg-right">
                            <div class="same-style-2 header-search-1">
                                <a class="search-toggle" href="#">
                                    <i class="icon-magnifier s-open"></i>
                                    <i class="icon_close s-close"></i>
                                </a>
                                <div class="search-wrap-1">
                                    <form method="GET" action="{{route('shop')}}">
                                        <input name="query" placeholder="Search products…" type="text">
                                        <button class="button-search"><i class="icon-magnifier"></i></button>
                                    </form>
                                </div>
                            </div>
                            @guest
                            <div class="same-style-2">
                                <a href="{{route('login')}}"><i class="icon-user"></i></a>
                            </div>
                            @endguest
                            @auth
                            <div class="same-style-2">
                                <a href="{{route('home')}}"><i class="icon-user"></i></a>
                            </div>
                            @endauth
                            <div class="same-style-2">
                                <a href="{{route('wishlist')}}"><i class="icon-heart"></i><span class="pro-count red wishlist-count">0</span></a>
                            </div>
                            <div class="same-style-2 header-cart">
                                <a href="{{route('myShoppingCart')}}">
                                    <i class="icon-basket-loaded"></i><span class="pro-count shooping-cart-count red">
                                        @if(auth()->check())
                                            {{auth()->user()->products->count()}}
                                        @else
                                            0
                                        @endif
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-small-device small-device-ptb-1">
            <div class="row align-items-center">
                <div class="col-5">
                    <div class="mobile-logo">
                        <a href="index.html">
                            <img alt="logo" height="50" src="{{ asset('images/logo/logo.png') }}">
                        </a>
                    </div>
                </div>
                <div class="col-7">
                    <div class="header-action header-action-flex">
                        @guest
                        <div class="same-style-2">
                            <a href="{{route('login')}}"><i class="icon-user"></i></a>
                        </div>
                        @endguest
                        @auth
                        <div class="same-style-2">
                            <a href="{{route('home')}}"><i class="icon-user"></i></a>
                        </div>
                        @endauth
                        <div class="same-style-2">
                            <a href="{{route('wishlist')}}"><i class="icon-heart"></i><span class="pro-count red wishlist-count">0</span></a>
                        </div>
                        <div class="same-style-2 header-cart">
                            <a href="{{route('myShoppingCart')}}">
                                <i class="icon-basket-loaded"></i><span class="pro-count red shooping-cart-count">
                                    @if(auth()->check())
                                        {{auth()->user()->products->count()}}
                                    @else
                                        0
                                    @endif
                                </span>
                            </a>
                        </div>
                        <div class="same-style-2 main-menu-icon">
                            <a class="mobile-header-button-active" href="#"><i class="icon-menu"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


