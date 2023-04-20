<header>
    <div class="container-fluid">
        <div class="header-large-device">
            <div class="header-bottom">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo">
                            <a href="index.html"><img src="{{ asset('/images/logo/logo.png') }}" alt="logo"></a>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7">
                        <div class="main-menu main-menu-padding-1 main-menu-lh-1">
                            <nav>
                                <ul>
                                    <li><a href="index.html">HOME </a>
                                        <ul class="sub-menu-style">
                                            <li><a href="index.html">Home version 1 </a></li>
                                            <li><a href="index-2.html">Home version 2</a></li>
                                            <li><a href="index-3.html">Home version 3</a></li>
                                            <li><a href="index-4.html">Home version 4</a></li>
                                            <li><a href="index-5.html">Home version 5</a></li>
                                            <li><a href="index-6.html">Home version 6</a></li>
                                            <li><a href="index-7.html">Home version 7</a></li>
                                            <li><a href="index-8.html">Home version 8</a></li>
                                            <li><a href="index-9.html">Home version 9</a></li>
                                            <li><a href="index-10.html">Home version 10</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="shop.html">SHOP </a>
                                        <ul class="mega-menu-style mega-menu-mrg-1">
                                            <li>
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-title" href="#">Shop Layout</a>
                                                        <ul>
                                                            <li><a href="shop.html">standard style</a></li>
                                                            <li><a href="shop-list.html">shop list style</a></li>
                                                            <li><a href="shop-fullwide.html">shop fullwide</a></li>
                                                            <li><a href="shop-no-sidebar.html">grid no sidebar</a></li>
                                                            <li><a href="shop-list-no-sidebar.html">list no sidebar</a></li>
                                                            <li><a href="shop-right-sidebar.html">shop right sidebar</a></li>
                                                            <li><a href="store-location.html">store location</a></li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-title" href="#">Products Layout</a>
                                                        <ul>
                                                            <li><a href="product-details.html">tab style 1</a></li>
                                                            <li><a href="product-details-2.html">tab style 2</a></li>
                                                            <li><a href="product-details-sticky.html">sticky style</a></li>
                                                            <li><a href="product-details-gallery.html">gallery style </a></li>
                                                            <li><a href="product-details-affiliate.html">affiliate style</a></li>
                                                            <li><a href="product-details-group.html">group style</a></li>
                                                            <li><a href="product-details-fixed-img.html">fixed image style </a></li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <a href="shop.html"><img src="{{ asset('images/banner/banner-12.png') }}" alt=""></a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="#">PAGES </a>
                                        <ul class="sub-menu-style">
                                            <li><a href="about-us.html">about us </a></li>
                                            <li><a href="cart.html">cart page</a></li>
                                            <li><a href="checkout.html">checkout </a></li>
                                            <li><a href="my-account.html">my account</a></li>
                                            <li><a href="wishlist.html">wishlist </a></li>
                                            <li><a href="compare.html">compare </a></li>
                                            <li><a href="contact.html">contact us </a></li>
                                            <li><a href="order-tracking.html">order tracking</a></li>
                                            <li><a href="login-register.html">login / register </a></li>
                                        </ul>
                                    </li>
                                    <li><a href="blog.html">BLOG </a>
                                        <ul class="sub-menu-style">
                                            <li><a href="blog.html">blog standard </a></li>
                                            <li><a href="blog-no-sidebar.html">blog no sidebar </a></li>
                                            <li><a href="blog-right-sidebar.html">blog right sidebar</a></li>
                                            <li><a href="blog-details.html">blog details</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="contact.html">CONTACT </a></li>
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
                                    <form action="#">
                                        <input placeholder="Search products…" type="text">
                                        <button class="button-search"><i class="icon-magnifier"></i></button>
                                    </form>
                                </div>
                            </div>
                            @guest
                            <div class="same-style-2">
                                <a href="{{route('login')}}"><i class="icon-user"></i></a>
                            </div>
                            @endguest
                            <div class="same-style-2">
                                <a href="wishlist.html"><i class="icon-heart"></i><span class="pro-count red">03</span></a>
                            </div>
                            <div class="same-style-2 header-cart">
                                <a class="cart-active" href="#">
                                    <i class="icon-basket-loaded"></i><span class="pro-count red">02</span>
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
                            <img alt="" src="{{ asset('images/logo/logo.png') }}">
                        </a>
                    </div>
                </div>
                <div class="col-7">
                    <div class="header-action header-action-flex">
                        <div class="same-style-2">
                            <a href="login-register.html"><i class="icon-user"></i></a>
                        </div>
                        <div class="same-style-2">
                            <a href="wishlist.html"><i class="icon-heart"></i><span class="pro-count red">03</span></a>
                        </div>
                        <div class="same-style-2 header-cart">
                            <a class="cart-active" href="#">
                                <i class="icon-basket-loaded"></i><span class="pro-count red">02</span>
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


