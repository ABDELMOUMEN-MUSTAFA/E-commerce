<!-- Mobile menu start -->
<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="clickalbe-sidebar-wrap">
        <a class="sidebar-close"><i class="icon_close"></i></a>
        <div class="mobile-header-content-area">
            <div class="mobile-search mobile-header-padding-border-1">
                <form class="search-form" method="GET" action="{{route('shop')}}">
                    <input type="text" name="query" placeholder="Search here…">
                    <button class="button-search"><i class="icon-magnifier"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-padding-border-2">
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu">
                        <li class="menu-item-has-children"><a href="{{route('index')}}">Home</a></li>
                        <li class="menu-item-has-children "><a href="{{route('shop')}}">shop</a></li>
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-contact-info mobile-header-padding-border-4">
                <ul>
                    <li><i class="icon-phone "></i> (+612) 2531 5600</li>
                    <li><i class="icon-envelope-open "></i> norda@domain.com</li>
                    <li><i class="icon-home"></i> PO Box 1622 Colins Street West Australia</li>
                </ul>
            </div>
        </div>
    </div>
</div>