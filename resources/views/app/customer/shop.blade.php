@extends('layouts.customer.app')

@section('title', 'SHOP')

@section('styles')
<style>
    .current {
        color: red !important;
    }

    .product-price span.new-price {
        color: red;
    }

    .product-price span.old-price {
        font-size: 16px;
        color: #999999;
        text-decoration: line-through;
    }

    .product-price span {
        font-size: 20px;
        color: #000000;
        font-family: "Heebo", sans-serif;
        display: inline-block;
        margin: 0 4px;
    }

    .single-product-wrap .product-img .product-action-2 button:hover {
        background-color: #ff0000;
        border: 1px solid #ff0000;
        color: #ffffff;
    }

    .multiline-ellipsis {
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3; 
        white-space: pre-wrap; 
    }
</style>
@endsection

@section('content')
 <div class="breadcrumb-area bg-gray">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <ul>
                        <li>
                            <a href="{{route('index')}}">Home</a>
                        </li>
                        <li class="active">Shop</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="shop-area pt-120">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-lg-9">
                        <div class="shop-topbar-wrapper">
                            <div class="shop-topbar-left">
                                <div class="view-mode nav">
                                    <a class="active" href="#shop-1" data-toggle="tab"><i class="icon-grid"></i></a>
                                    <a href="#shop-2" data-toggle="tab"><i class="icon-menu"></i></a>
                                </div>
                                <p>Showing {{$products->firstItem()}} - {{$products->lastItem()}} of {{$products->total()}} results </p>
                            </div>
                            <div class="product-sorting-wrapper">
                                <div class="product-show shorting-style">
                                    <label>Sort by :</label>
                                    <select id="sort-by">
                                        {{request()->criteria}}
                                        <option @if(request()->criteria === "") selected @endif value="default">Default</option>
                                        <option @if(request()->criteria === "name") selected @endif value="name">Name</option>
                                        <option @if(request()->criteria === "price") selected @endif value="price">Price</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="shop-bottom-area">
                            <div class="tab-content jump">
                                <div id="shop-1" class="tab-pane active">
                                    <div class="row">
                                        @foreach($products as $product)
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                            <div class="single-product-wrap mb-35">
                                                <div class="product-img product-img-zoom mb-15">
                                                    <a href="{{route('productDetails', $product->id)}}">
                                                        <img class="image" src="{{asset($product->photos->where('is_primary', true)->first()->source)}}" alt="product image">
                                                    </a>
                                                    <div class="product-action-2 tooltip-style-2">
                                                        <button class="wishlist" title="Wishlist"><i class="icon-heart"></i></button>
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap-2 text-center">
                                                    <div class="product-rating-wrap">
                                                        <div class="product-rating">
                                                            {!! str_repeat('<i class="yellow icon_star"></i>', floor($product->reviews->avg('number_stars'))) !!}{!! str_repeat('<i style="color: #535353;" class="icon_star"></i>', 5 - floor($product->reviews->avg('number_stars'))) !!}
                                                        </div>
                                                        @if($product->reviews)
                                                            <span>({{$product->reviews->count()}})</span>
                                                        @else
                                                            <span>(0)</span>
                                                        @endif
                                                    </div>
                                                    <h3><a class="product-name" href="{{route('productDetails', $product->id)}}">{{$product->name}}</a></h3>
                                                    @if($product->discount)
                                                    <div class="product-price">
                                                        <span class="new-price">${{trim($product->price, '$') * $product->discount * 0.01}}</span>
                                                        <span class="old-price">{{$product->price}}</span>
                                                    </div>
                                                    @else
                                                    <div class="product-price-2">
                                                        <span>{{$product->price}}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="product-content-wrap-2 product-content-position text-center">
                                                    <div class="product-rating-wrap">
                                                        <div class="product-rating">
                                                            {!! str_repeat('<i class="yellow icon_star"></i>', floor($product->reviews->avg('number_stars'))) !!}{!! str_repeat('<i style="color: #535353;" class="icon_star"></i>', 5 - floor($product->reviews->avg('number_stars'))) !!}
                                                        </div>
                                                        @if($product->reviews)
                                                            <span>({{$product->reviews->count()}})</span>
                                                        @else
                                                            <span>(0)</span>
                                                        @endif
                                                    </div>
                                                    <h3><a href="{{route('productDetails', $product->id)}}">{{$product->name}}</a></h3>
                                                    @if($product->discount)
                                                    <div class="product-price">
                                                        <span class="new-price">${{trim($product->price, '$') * $product->discount * 0.01}}</span>
                                                        <span class="old-price price">{{$product->price}}</span>
                                                    </div>
                                                    @else
                                                    <div class="product-price-2">
                                                        <span class="price">{{$product->price}}</span>
                                                    </div>
                                                    @endif
                                                    <div class="pro-add-to-cart">
                                                        <button data-id="{{$product->id}}" class="add-to-shoppingcart" title="Add to Cart">Add To Cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div id="shop-2" class="tab-pane">
                                    @foreach($products as $product)
                                    <div class="shop-list-wrap mb-30">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-6">
                                                <div class="product-list-img">
                                                    <a href="{{route('productDetails', $product->id)}}">
                                                        <img class="image" src="{{asset($product->photos->where('is_primary', true)->first()->source)}}" alt="Product image">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-xl-8 col-lg-7 col-md-6 col-sm-6">
                                                <div class="shop-list-content">
                                                    <h3><a class="product-name" href="{{route('productDetails', $product->id)}}">{{$product->name}}</a></h3>
                                                    @if($product->discount)
                                                    <div class="pro-list-price">
                                                        <span class="new-price">${{trim($product->price, '$') * $product->discount * 0.01}}</span>
                                                        <span class="old-price price">{{$product->price}}</span>
                                                    </div>
                                                    @else
                                                    <div class="product-price-2">
                                                        <span class="price">{{$product->price}}</span>
                                                    </div>
                                                    @endif
                                                    <div class="product-list-rating-wrap">
                                                        <div class="product-list-rating">
                                                            {!! str_repeat('<i class="yellow icon_star"></i>', floor($product->reviews->avg('number_stars'))) !!}{!! str_repeat('<i style="color: #535353;" class="icon_star"></i>', 5 - floor($product->reviews->avg('number_stars'))) !!}
                                                        </div>
                                                        @if($product->reviews)
                                                            <span>({{$product->reviews->count()}})</span>
                                                        @else
                                                            <span>(0)</span>
                                                        @endif
                                                    </div>
                                                    <p class="multiline-ellipsis">{{$product->description}}</p>
                                                    <div class="product-list-action">
                                                        <button data-id="{{$product->id}}" class="add-to-shoppingcart" title="Add To Cart"><i class="icon-basket-loaded"></i></button>
                                                        <button class="wishlist" title="Wishlist"><i class="icon-heart"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="pro-pagination-style text-center mt-10">
                                <ul>
                                    <li><a class="prev" href="{{$products->previousPageUrl()}}"><i class="icon-arrow-left"></i></a></li>
                                    @for($i = 1; $i <= $products->lastPage();$i++)
                                    <li><a @if($products->currentPage() === $i) class="active" @endif href="{{$products->url($i)}}">{{$i}}</a></li>
                                    @endfor
                                    <li><a class="next" href="{{$products->nextPageUrl()}}"><i class="icon-arrow-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="sidebar-wrapper sidebar-wrapper-mrg-right">
                            <div class="sidebar-widget mb-40">
                                <h4 class="sidebar-widget-title">Search </h4>
                                <div class="sidebar-search">
                                    <form class="sidebar-search-form" id="search">
                                        <input value="@if(isset(request()->query)){{request('query')}}@endif" type="text" name="query" placeholder="Search here...">
                                        <button>
                                            <i class="icon-magnifier"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="sidebar-widget shop-sidebar-border mb-35 pt-40">
                                <h4 class="sidebar-widget-title">Categories </h4>
                                <div class="shop-catigory">
                                    <ul>
                                        <li><a class="category @if(!isset(request()->category) || request()->category === 'All') current @endif" href="javascript:void(0)">All</a></li>
                                        @foreach($categories as $category)
                                        <li><a class="category @if(request()->category === $category->name) current @endif" href="{{route('shop', ['category' => $category->name])}}">{{$category->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-widget shop-sidebar-border mb-40 pt-40">
                                <h4 class="sidebar-widget-title">Price Filter </h4>
                                <div class="price-filter">
                                    <span>Range:  $16.00 - 400.00 </span>
                                    <div id="slider-range"></div>
                                    <div class="price-slider-amount">
                                        <div class="label-input">
                                            <input type="text" id="amount" name="price" readonly />
                                        </div>
                                        <button id="filter-by-price">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@include('includes.customer.footer')
@endsection


@section('scripts')
<script>
    $('#filter-by-price').click(function(){
        const priceMinMax = $('#amount')
        .val()
        .split('-')
        .map((price) => Number(price.trim().replace('$', '')));

        const currentCategory = $('.category.current').text().trim();

        window.location.href = `{{route('shop')}}/${currentCategory}/${$('#sort-by').val()}/${priceMinMax[0]}/${priceMinMax[1]}`;
    });

	$('#sort-by').change(function(){
        const priceMinMax = $('#amount')
        .val()
        .split('-')
        .map((price) => Number(price.trim().replace('$', '')));

        const currentCategory = $('.category.current').text().trim();
    
        window.location.href = `{{route("shop")}}/${currentCategory}/${$(this).val()}/${priceMinMax[0]}/${priceMinMax[1]}`;
    });

    $('.category').click(function(e){
        const priceMinMax = $('#amount')
        .val()
        .split('-')
        .map((price) => Number(price.trim().replace('$', '')));

        e.preventDefault();
        window.location.href = `{{route("shop")}}/${$(this).text().trim()}/${$('#sort-by').val()}/${priceMinMax[0]}/${priceMinMax[1]}`;
    });

    $('#search').submit(function(event){
        event.preventDefault();
        window.location.href = '?' + $(this).serialize();
    });

    $('.add-to-shoppingcart').one('click', function () {
        $.ajax({
            url : "{{route('addToShoppingCart')}}",
            type: 'POST',
            data : { "product_id" : $(this).data('id'), quantity : 1, "_token" : "{{ csrf_token() }}" },
            success: function(respose){
                $('.shooping-cart-count').each(function(index, counter){
                    counter.textContent = Number(counter.textContent) + 1;
                })
            },
            error : function(response, error, textStatus){
                if(textStatus !== 'Bad Request'){
                    window.location.href = "{{route('login')}}";
                }
            }
        });
    });

    $('.wishlist').one('click', function(){
        const $product = $(this).parent().parent().parent().parent();
        if(localStorage.getItem('products') === null){
            var products = [];
        }else{
            var products = JSON.parse(localStorage.getItem('products'));        
        }
        
        const product = {
            id: $product.find('button[data-id]').data('id'),
            name : $product.find('.product-name').text().trim(),
            image : $product.find('.image').attr('src'),
            unitPrice : $product.find('.price:eq(0)').text().replace('$', '').trim()
        };

        const isFound = products.some(p => {
            if (p.id === product.id) {
                return true;
            }

            return false;
        });

        if(isFound){
            return;
        }

        $('.wishlist-count').each(function(index, wishcount){
            wishcount.textContent = Number(wishcount.textContent) + 1;
        });

        products.push(product);

        localStorage.setItem('products', JSON.stringify(products));
    });
</script>
@endsection