@extends('layouts.customer.app')

@section('title', 'My Cart')

@section('styles')
<link rel="stylesheet" href="{{asset('css/plugins/toastr.min.css')}}" />
@endsection

@section('content')
<div class="breadcrumb-area bg-gray">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li class="active">Cart Page </li>
            </ul>
        </div>
    </div>
</div>
<div class="cart-main-area pt-115 pb-120">
    <div class="container">
        <h3 class="cart-page-title">Your cart items</h3>
        <div class="row">
        	@if(session('message'))
	        <div class="col-12">
	            <div class="alert alert-success bg-success text-white border-0 fade show" role="alert">
	                {!! session('message') !!}
	            </div>
	        </div>
	        @endif
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            		@if(count(auth()->user()->products) > 0)
                    <div class="table-content table-responsive cart-table-content" id="products">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Unit Price</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@php($total = 0)
                            	@foreach(auth()->user()->products as $product)
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="#"><img src="{{asset($product->photos->where('is_primary', true)->first()->source)}}" alt="product image" style="max-height: 90px"></a>
                                    </td>
                                    <td class="product-name"><a href="#">{{$product->name}}</a></td>
                                    <td class="product-price-cart"><span class="amount">{{$product->price}}</span></td>
                                    <td class="product-quantity pro-details-quality">
                                        <div class="cart-plus-minus">
                                        	<input type="hidden" name="product_id" value="{{$product->id}}" />
                                        	<input class="cart-plus-minus-box" type="text" name="quantity" value="{{$product->pivot->quantity}}">
                                        </div>
                                    </td>
                                    @php($total += trim($product->price, '$') * $product->pivot->quantity)
                                    <td class="product-total">${{trim($product->price, '$') * $product->pivot->quantity}}</td>
                                    <td class="product-remove">
                                        <a href="javascript:void(0)" data-id="{{$product->id}}" class="delete"><i class="icon_close"></i></a>
                                    </td>
                                </tr> 	
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    	<div class="alert alert-info bg-info text-white border-0" role="alert">
                            No products in shopping cart
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-shiping-update-wrapper">
                                <div class="cart-shiping-update">
                                    <a href="{{route('index')}}">Continue Shopping</a>
                                </div>
                                <div class="cart-clear">
                                    <button id="clear-shopping-cart">Clear Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-12 col-md-6 d-flex align-items-stretch">
                        <div class="discount-code-wrapper flex-fill">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4>
                            </div>
                            <div class="discount-code">
                                <p>Enter your coupon code if you have one.</p>
                                <input id="coupon" type="text" name="code" required />
                                <form class="mt-3">
                                	<button class="cart-btn-2" type="button" id="btn-coupon">Apply Coupon</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 d-flex align-items-stretch">
                        <div class="grand-totall mt-0 flex-fill">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                            </div>
                            <div>
                            	@if(isset($total))
	                            	<h4 class="grand-totall-title mt-3">Total <span id="total">${{$total}}</span></h4>
	                            @else
	                            	<h4 class="grand-totall-title mt-3">Total <span id="total">$0</span></h4>
	                            @endif
	                            <form id="create-order" method="POST" action="{{route('orders.store')}}">
	                            	@csrf
	                            	<a href="javascript:void(0)" onclick="event.preventDefault();document.getElementById('create-order').submit();">Place Order</a>
	                            </form>
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
<script src="{{asset('js/plugins/toastr.min.js')}}"></script>
<script>
	/*----------------------------
    	Cart Plus Minus Button
    ------------------------------ */
    const CartPlusMinus = $('.cart-plus-minus');
    CartPlusMinus.prepend('<div class="dec qtybutton">-</div>');
    CartPlusMinus.append('<div class="inc qtybutton">+</div>');
    $(".qtybutton").on("click", function() {
        var $button = $(this);
        var oldValue = $button.parent().find("input[name='quantity']").val();
        if ($button.text() === "+") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below one
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }

        // get Table Row
        const $tr = $button.parent().parent().parent();

        // get Product Price
        const productPrice = Number($tr.find('.product-price-cart').text().replace('$', ''));
        const productID = $tr.find('input[name="product_id"]').val();

        
        $button.parent().find("input[name='quantity']").val(newVal);

        $.ajax({
			url : '/updateShoppingCart',
			type: 'PATCH',
			data : { "product_id" : productID, "quantity" : newVal ,"_token" : "{{csrf_token()}}" },
			success: function(response){
				// set Total Value
       	 		$tr.find('.product-total').text(`$${productPrice * newVal}`);

       	 		// Total
       	 		const total = $('.product-total')
       	 		.text()
       	 		.split('$')
       	 		.filter(Boolean)
       	 		.map(Number)
       	 		.reduce((a, b) => a + b, 0);

       	 		$('#total').text(`$${total}`);
			},
			error: function(response){
				console.log(response);
			}	
		});

    });

    // Remove product from shopping cart
    $('.delete').click(function(){
    	const $tr = $(this).parent().parent();
    	$.ajax({
			url : '/removeProductFromShoppingCart/' + $(this).data('id'),
			type: 'DELETE',
			data : { "_token" : "{{csrf_token()}}" },
			success: function(response){
				$tr.remove();
			},
			error: function(response){
				console.log(response);
			}	
		});
    });

    // clear shopping cart
    $('#clear-shopping-cart').click(function(){
    	$.ajax({
			url : '/clearAllShoppingCart',
			type: 'DELETE',
			data : { "_token" : "{{csrf_token()}}" },
			success: function(response){
				$('#products').replaceWith(`
					<div class="alert alert-info bg-info text-white border-0" role="alert">
                        No products in shopping cart
                    </div>
                `);
                $('#total').text('$0');
			},
			error: function(response){
				console.log(response);
			}	
		});
    });

    // Apply coupon
    $('#btn-coupon').click(function(){
    	const couponCode = $('#coupon').val().trim();
    	$.get(`/coupons/${couponCode}/checkCoupon`, function(response){
    		$('#create-order').append(`<input type="hidden" name="code" value="${couponCode}" />`);
    		$('#coupon').attr('readonly', true).css({backgroundColor: "#17fa17", color: "black"});
    		toastr["success"](response.message);
    	}).fail(function(response){
    		toastr["error"]("Invalid coupon code.");
    	});
    });
</script>
@endsection