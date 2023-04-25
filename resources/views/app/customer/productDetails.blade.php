@extends('layouts.customer.app')

@section('title', 'Product Details')

@section('content')
<div class="breadcrumb-area bg-gray">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{route('index')}}">Home</a>
                </li>
                <li class="active">product details</li>
            </ul>
        </div>
    </div>
</div>
<div class="product-details-area pt-120 pb-115">
    <div class="container">
        <div class="row">
            @if(session('message'))
            <div class="col-12">
                <div class="alert alert-success bg-success text-white border-0 fade show" role="alert">
                    {!! session('message') !!}
                </div>
            </div>
            @endif
            <div class="col-lg-6 col-md-6">
                <div class="product-details-tab">
                    <div class="pro-dec-big-img-slider">
                        @foreach($product->photos as $photo)
                        <div class="easyzoom-style">
                            <div class="easyzoom easyzoom--overlay">
                                <a href="{{ asset($photo->source) }}">
                                    <img src="{{ asset($photo->source) }}" alt="product image">
                                </a>
                            </div>
                            <a class="easyzoom-pop-up img-popup" href="{{ asset($photo->source) }}"><i class="icon-size-fullscreen"></i></a>
                        </div>
                        @endforeach
                    </div>
                    <div class="product-dec-slider-small product-dec-small-style1">
                        @foreach($product->photos as $photo)
                        <div class="product-dec-small">
                            <img src="{{ asset($photo->source) }}" alt="product image">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product-details-content pro-details-content-mrg">
                    <h2 class="product-name">{{$product->name}}</h2>
                    <div class="product-ratting-review-wrap">
                        <div class="product-ratting-digit-wrap">
                            <div class="product-ratting">
                                {!! str_repeat('<i class="yellow icon_star"></i>', floor($product->reviews->avg('number_stars'))) !!}
                            </div>
                            <div class="product-digit">
                                <span>{{round($product->reviews->avg('number_stars'), 2)}}</span>
                            </div>
                        </div>
                        <div class="product-review-order">
                            <span>{{ $product->reviews->count() }} Reviews</span>
                            <span>{{ $product->orders->count() }} orders</span>
                        </div>
                    </div>
                    @php($discount = 0)
                    @foreach($product->promotions as $promotion)
                        @if($promotion->end_date >= now())
                            @php($discount = $promotion->discount)
                            @break
                        @endif
                    @endforeach

                    @if($discount === 0)
                    <div class="pro-details-price">
                        <span class="price">{{$product->price}}</span>
                    </div>
                    @else
                    <div class="pro-details-price">
                        <span class="new-price">${{trim($product->price, '$') * $discount * 0.01}}</span>
                        <span class="old-price">${{$product->price}}</span>
                    </div>
                    @endif
                    @if(count($product->productVariants) > 0)
                    <div class="pro-details-color-wrap">
                        <span>Color:</span>
                        <div class="pro-details-color-content">
                            <ul>
                                @foreach($product->productVariants as $variant)
                                    <li><a style="background-color: {{$variant->color->name}}" href="#">{{$variant->color->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="pro-details-size">
                        <span>Size:</span>
                        <div class="pro-details-size-content">
                            <ul>
                                @foreach($product->productVariants as $variant)
                                    @foreach($variant->sizes as $size)
                                        <li><a href="#">{{$size->name}}</a></li>
                                    @endforeach
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    <div class="description mb-3">
                        <p>{{$product->description}}</p>
                    </div>
                    <div class="pro-details-action-wrap">
                        <div class="pro-details-add-to-cart">
                            <a href="javascript:void(0)" data-id="{{$product->id}}" class="add-to-shoppingcart">Add To Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="description-review-wrapper pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="dec-review-topbar nav mb-45">
                    <a class="active" data-toggle="tab" href="#des-details1">Reviews and Ratting </a>
                </div>
                <div class="tab-content dec-review-bottom">
                    <div id="des-details1" class="tab-pane active">
                        <div class="review-wrapper">
                            @foreach($product->reviews as $review)
                            <div style="margin-bottom: 10px;" class="single-review">
                                <div class="review-img">
                                    <img height="50" src="{{ asset($review->user->avatar) }}" alt="client image">
                                </div>
                                <div class="review-content">
                                    <div class="review-top-wrap">
                                        <div class="review-name">
                                            <h5><span>{{$review->user->first_name}} {{$review->user->last_name}}</span> - {{$review->created_at->format('F d, Y')}}</h5>
                                        </div>
                                        <div class="review-rating" style="margin-left: 30px;">
                                            {!! str_repeat('<i class="yellow icon_star"></i>', $review->number_stars) !!}
                                        </div>
                                    </div>
                                    <p>{{$review->comment}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="ratting-form-wrapper">
                            <div class="ratting-form">
                                <form id="review-form" method="POST" action="{{route('reviews.store')}}">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="star-box-wrap">
                                                <div class="single-ratting-star rating">
                                                    <a class="stars" href="javascript:void(0)"><i class="icon_star"></i></a>
                                                </div>
                                                <div class="single-ratting-star rating">
                                                    <a class="stars" href="javascript:void(0)"><i class="icon_star"></i></a>
                                                    <a class="stars" href="javascript:void(0)"><i class="icon_star"></i></a>
                                                </div>
                                                <div class="single-ratting-star rating">
                                                    <a class="stars" href="javascript:void(0)"><i class="icon_star"></i></a>
                                                    <a class="stars" href="javascript:void(0)"><i class="icon_star"></i></a>
                                                    <a class="stars" href="javascript:void(0)"><i class="icon_star"></i></a>
                                                </div>
                                                <div class="single-ratting-star rating">
                                                    <a class="stars" href="javascript:void(0)"><i class="icon_star"></i></a>
                                                    <a class="stars" href="javascript:void(0)"><i class="icon_star"></i></a>
                                                    <a class="stars" href="javascript:void(0)"><i class="icon_star"></i></a>
                                                    <a class="stars" href="javascript:void(0)"><i class="icon_star"></i></a>
                                                </div>
                                                <div class="single-ratting-star rating">
                                                    <a class="stars" style="color: #f5b223" href="javascript:void(0)"><i class="icon_star"></i></a>
                                                    <a class="stars" style="color: #f5b223" href="javascript:void(0)"><i class="icon_star"></i></a>
                                                    <a class="stars" style="color: #f5b223" href="javascript:void(0)"><i class="icon_star"></i></a>
                                                    <a class="stars" style="color: #f5b223" href="javascript:void(0)"><i class="icon_star"></i></a>
                                                    <a class="stars" style="color: #f5b223" href="javascript:void(0)"><i class="icon_star"></i></a>
                                                    <input type="hidden" name="number_stars" value="5" />
                                                </div>
                                            </div>
                                            @error('number_stars')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <div class="rating-form-style mb-20">
                                                <label>Your review <span>*</span></label>
                                                <textarea name="comment"></textarea>
                                                @error('comment')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-submit">
                                                <input type="submit" value="Submit">
                                            </div>
                                        </div>
                                    </div>
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="related-product pb-115">
    <div class="container">
        <div class="section-title mb-45 text-center">
            <h2>Popular Products</h2>
        </div>
        <div class="related-product-active">
            @foreach($bestSellingProducts as $product)
            <div class="product-plr-1">
                <div class="single-product-wrap">
                    <div class="product-img product-img-zoom mb-15">
                        <a href="{{route('productDetails', $product->id)}}">
                            <img class="image" src="{{ asset($product->source) }}" alt="product image">
                        </a>
                        <div class="product-action-2 tooltip-style-2">
                            <button class="wishlist" title="Wishlist"><i class="icon-heart"></i></button>
                        </div>
                    </div>
                    <div class="product-content-wrap-2 text-center">
                        <h3><a href="{{route('productDetails', $product->id)}}" class="product-name">{{$product->name}}</a></h3>
                        <div class="product-price-2">
                            <span class="price">${{$product->price}}</span>
                        </div>
                    </div>
                    <div class="product-content-wrap-2 product-content-position text-center">
                        <h3><a href="{{route('productDetails', $product->id)}}">{{$product->name}}</a></h3>
                        <div class="product-price-2">
                            <span>${{$product->price}}</span>
                        </div>
                        <div class="pro-add-to-cart">
                            <button data-id="{{$product->id}}" class="add-to-shoppingcart">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@include('includes.customer.footer')
@endsection


@section('scripts')
<script>
    $('.rating').click(function(){
        $(`[name="number_stars"]`).remove();

        $('.stars').css({ color : "#535353" });
        $(this).children().each(function(index, child){
            child.style.color = "#f5b223";
        });
        $(this).append(`<input type="hidden" name="number_stars" value="${$(this).children().length}" />`);
    });

    $('.wishlist').one('click', function(){
        const $product = $(this).parent().parent().parent();
        if(localStorage.getItem('products') === null){
            var products = [];
        }else{
            var products = JSON.parse(localStorage.getItem('products'));        
        }
        
        const product = {
            id: $product.find('.add-to-shoppingcart').data('id'),
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
</script>
@endsection