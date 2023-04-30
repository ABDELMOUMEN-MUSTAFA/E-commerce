@extends('layouts.customer.app')

@php
use App\Models\Product;
@endphp

@section('content')
        <div class="slider-area bg-gray">
            <div style="padding-top: 10px" class="hero-slider-active-1 hero-slider-pt-1 nav-style-1 dot-style-1">
                @foreach($sliders as $slider)
                <div class="single-hero-slider single-animation-wrap">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="hero-slider-content-1 hero-slider-content-1-pt-1 slider-animated-1">
                                    <h4 class="animated">{{$slider->name}}</h4>
                                    <h1 class="animated">{{$slider->title}}</h1>
                                    <p class="animated">{{$slider->description}}</p>
                                    <div class="btn-style-1">
                                        <a class="animated btn-1-padding-1" href="#">Explore Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="hero-slider-img-1 slider-animated-1">
                                    <img class="animated" src="{{ asset($slider->photo) }}" alt="slider photo">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="service-area">
            <div class="container">
                <div class="service-wrap">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="single-service-wrap mb-30">
                                <div class="service-icon">
                                    <i class="icon-cursor"></i>
                                </div>
                                <div class="service-content">
                                    <h3>Free Shipping</h3>
                                    <span>Orders over $100</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="single-service-wrap mb-30">
                                <div class="service-icon">
                                    <i class="icon-reload"></i>
                                </div>
                                <div class="service-content">
                                    <h3>Free Returns</h3>
                                    <span>Within 30 days</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="single-service-wrap mb-30">
                                <div class="service-icon">
                                    <i class="icon-lock"></i>
                                </div>
                                <div class="service-content">
                                    <h3>100% Secure</h3>
                                    <span>Payment Online</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="single-service-wrap mb-30">
                                <div class="service-icon">
                                    <i class="icon-tag"></i>
                                </div>
                                <div class="service-content">
                                    <h3>Best Price</h3>
                                    <span>Guaranteed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="about-us-area pt-85">
            <div class="container">
                <div class="border-bottom-1 about-content-pb">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="about-us-logo text-center">
                                <img src="{{ asset('images/logo/logo.png') }}" height="150" alt="logo">
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="about-us-content">
                                <p>Welcome to our store, where we offer a wide range of both digital and physical products to cater to all of your needs. We are committed to providing our customers with a convenient and personalized shopping experience that matches their unique preferences and lifestyles.</p>
                                <div class="signature">
                                    <h2>ABDELMOUMEN MUSTAFA</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-area section-padding-1 pt-115 pb-75">
            <div class="container">
                <div class="section-title-tab-wrap mb-45">
                    <div class="section-title">
                        <h2>Featured Products</h2>
                    </div>
                    <div class="tab-style-1 nav">
                        <a class="active" href="#product-1" data-toggle="tab">Best Selling</a>
                        <a href="#product-2" data-toggle="tab">New Arrivals</a>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="tab-content jump">
                    <div id="product-1" class="tab-pane active">
                        <div class="row">
                            @foreach($bestSellingProducts as $product)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="single-product-wrap mb-35">
                                    <div class="product-img product-img-zoom mb-20">
                                        <a href="{{route('productDetails', $product->id)}}">
                                            <img class="image" src="{{ asset($product->source) }}" alt="product image">
                                        </a>
                                        @php($discount = 0)
                                        @if($product->quantity_in_stock === 0)
                                            <span class="pro-badge left bg-black">Out of stock</span>
                                            @else
                                                <!-- This Is Really Bad, I Know -->
                                                @php($p = Product::find($product->id))
                                                @foreach($p->promotions as $promotion)
                                                    @if($promotion->end_date >= now())
                                                        <span class="pro-badge left bg-red">-{{$promotion->discount}}%</span>
                                                        @php($discount = $promotion->discount)
                                                        @break
                                                    @endif
                                                @endforeach
                                        @endif
                                        <div class="product-action-wrap">
                                            <div class="product-action-left">
                                                <button data-id="{{$product->id}}" class="add-to-shoppingcart"><i class="icon-basket-loaded"></i>Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-content-left">
                                            <h4><a href="{{route('productDetails', $product->id)}}" class="product-name">{{$product->name}}</a></h4>
                                            @if($discount === 0)
                                            <div class="product-price">
                                                <span class="price">${{$product->price}}</span>
                                            </div>
                                            @else
                                            <div class="product-price">
                                                <span class="new-price">${{trim($product->price, '$') * $discount * 0.01}}</span>
                                                <span class="old-price">{{$product->price}}</span>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="product-content-right tooltip-style">
                                            <button class="font-inc wishlist"><i class="icon-heart"></i><span>Wishlist</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="product-2" class="tab-pane">
                        <div class="row">
                            @foreach($newArrivals as $product)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="single-product-wrap mb-35">
                                    <div class="product-img product-img-zoom mb-20">
                                        <a href="{{route('productDetails', $product->id)}}">
                                            <img class="image" src="{{ asset($product->photos->where('is_primary', true)->first()->source) }}" alt="product image">
                                        </a>
                                        @php($discount = 0)
                                        @if($product->quantity_in_stock === 0)
                                            <span class="pro-badge left bg-black">Out of stock</span>
                                            @else
                                                <!-- This Is Really Bad, I Know -->
                                                @php($p = Product::find($product->id))
                                                @foreach($p->promotions as $promotion)
                                                    @if($promotion->end_date >= now())
                                                        <span class="pro-badge left bg-red">-{{$promotion->discount}}%</span>
                                                        @php($discount = $promotion->discount)
                                                        @break
                                                    @endif
                                                @endforeach
                                        @endif
                                        <div class="product-action-wrap">
                                            <div class="product-action-left">
                                                <button data-id="{{$product->id}}" class="add-to-shoppingcart"><i class="icon-basket-loaded"></i>Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-content-left">
                                            <h4><a href="{{route('productDetails', $product->id)}}" class="product-name">{{$product->name}}</a></h4>
                                            @if($discount === 0)
                                            <div class="product-price">
                                                <span class="price">{{$product->price}}</span>
                                            </div>
                                            @else
                                            <div class="product-price">
                                                <span class="new-price">${{trim($product->price, '$') * $discount * 0.01}}</span>
                                                <span class="old-price">{{$product->price}}</span>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="product-content-right tooltip-style">
                                            <button class="font-inc wishlist"><i class="icon-heart"></i><span>Wishlist</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($ourCollections->count() > 0)
        <div class="banner-area pb-85">
            <div class="container">
                <div class="section-title mb-45">
                    <h2>Our Collections</h2>
                </div>
                <div class="row">
                    @if($collection = $ourCollections->where('type', 'big')->first())
                    <div class="col-lg-7 col-md-7">
                        <div class="banner-wrap banner-mr-1 mb-30">
                            <div class="banner-img banner-img-zoom">
                                <a href="#"><img height="550" src="{{ asset($collection->photo) }}" alt=""></a>
                            </div>
                            <div class="banner-content-1">
                                <h2>{{$collection->title}}</h2>
                                <p>{{$collection->description}}</p>
                                <div class="btn-style-1">
                                    <a class="animated btn-1-padding-2" href="#">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($collection = $ourCollections->where('type', 'small')->first())
                    <div class="col-lg-5 col-md-5">
                        <div class="banner-wrap  banner-ml-1 mb-30">
                            <div class="banner-img banner-img-zoom">
                                <a href="#"><img height="550" src="{{ asset($collection->photo) }}" alt=""></a>
                            </div>
                            <div class="banner-content-2">
                                <h2>{{$collection->title}}</h2>
                                <p>{{$collection->description}}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
        @include('includes.customer.footer')
@endsection



@section('scripts')
<script>
    $('.add-to-shoppingcart').one('click', function () {
        $.ajax({
            url : '/addToShoppingCart',
            type: 'POST',
            data : { "product_id" : $(this).data('id'), quantity : 1, "_token" : "{{ csrf_token() }}" },
            success: function(respose){
                $('.shooping-cart-count').each(function(index, counter){
                    counter.textContent = Number(counter.textContent) + 1;
                })
            },
            error : function(respose, textStatus, xhr){
                if(xhr.status !== 400){
                    window.location.href = "{{route('login')}}";
                }
            }
        });
    });

    $('.wishlist').one('click', function(){
        const $product = $(this).parent().parent().parent();
        if(localStorage.getItem('products') === null){
            var products = [];
        }else{
            var products = JSON.parse(localStorage.getItem('products'));        
        }
        
        const product = {
            id: $product.find('button[data-id]').data('id'),
            name : $product.find('.product-name').text().trim(),
            image : $product.find('.image').attr('src'),
            unitPrice : $product.find('.price').text().replace('$', '').trim()
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