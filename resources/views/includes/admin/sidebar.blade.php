<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- LOGO -->
    <a href="{{route('index')}}" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('/images/logo/logo.png') }}" alt="logo" height="90">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('/images/logo/logo.png') }}" alt="logo" height="90">
        </span>
    </a>

    <!-- LOGO -->
    <a href="{{route('index')}}" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('/images/logo/logo.png') }}" alt="" height="90">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('/images/logo/logo.png') }}" alt="" height="90">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar="">

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title side-nav-item">Analytics</li>

            <li class="side-nav-item">
                <a href="{{route('home')}}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="side-nav-title side-nav-item">Management</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarCategories" aria-expanded="false" aria-controls="sidebarCategories" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span>Manage Categories</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarCategories">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('categories.index') }}">All Categories</a>
                        </li>
                        <li>
                            <a href="{{ route('categories.create') }}">Add Category</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarSubcategories" aria-expanded="false" aria-controls="sidebarSubcategories" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span>Manage Subcategories</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarSubcategories">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('subcategories.index') }}">All Subcategories</a>
                        </li>
                        <li>
                            <a href="{{ route('subcategories.create') }}">Add Subcategory</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarProducts" aria-expanded="false" aria-controls="sidebarProducts" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span>Manage Products</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarProducts">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('products.index') }}">All Products</a>
                        </li>
                        <li>
                            <a href="{{ route('products.create') }}">Add Product</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarVariants" aria-expanded="false" aria-controls="sidebarVariants" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span>Manage Variants</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarVariants">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('colors.index')}}">All Colors</a>
                        </li>
                        <li>
                            <a href="{{route('sizes.index')}}">All Sizes</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarCoupons" aria-expanded="false" aria-controls="sidebarCoupons" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span>Manage Coupons</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarCoupons">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('coupons.index')}}">All Coupons</a>
                        </li>
                        <li>
                            <a href="{{route('coupons.create')}}">Generate Coupon</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarUsers" aria-expanded="false" aria-controls="sidebarUsers" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span>Manage Users</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarUsers">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('users.index')}}">All Users</a>
                        </li>
                        <li>
                            <a href="{{route('users.create')}}">Add Admin</a>
                        </li>
                        <li>
                            <a href="{{route('countries.index')}}">All Countries</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarOrders" aria-expanded="false" aria-controls="sidebarOrders" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span>Manage Orders</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarOrders">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('orders.index')}}">All Orders</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarSlider" aria-expanded="false" aria-controls="sidebarSlider" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span>Manage Sliders</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarSlider">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('sliders.index')}}">All Sliders</a>
                        </li>
                        <li>
                            <a href="{{route('sliders.create')}}">Add Slider</a>
                        </li>
                        <li>
                            <a href="{{route('ourCollection')}}">Our Collections</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <!-- End Sidebar -->
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->