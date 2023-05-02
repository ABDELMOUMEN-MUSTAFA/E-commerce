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
                    <li><i class="icon-phone "></i> (+212) 649721816</li>
                    <li><i class="icon-envelope-open "></i> shopfrommestore@gmail.com</li>
                    <li><i class="icon-home"></i> rue Jean Jacques Rousseau, 2°et. appt. 5, Grand Casablanca</li>
                </ul>
            </div>
        </div>
    </div>
</div>