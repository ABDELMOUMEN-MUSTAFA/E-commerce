<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('images/logo.png') }}" alt="logo" height="16">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('images/logo_sm.png') }}" alt="logo" height="16">
        </span>
    </a>

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('images/logo-dark.png') }}" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('images/logo_sm_dark.png') }}" alt="" height="16">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar="">

        <!--- Sidemenu -->
        <ul class="side-nav">
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
                <a href="apps-social-feed.html" class="side-nav-link">
                    <i class="uil-rss"></i>
                    <span> Dashboard </span>
                </a>
            </li>
        </ul>
        <!-- End Sidebar -->
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->