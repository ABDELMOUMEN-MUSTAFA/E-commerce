@extends('layouts.customer.app')

@section('title', 'My Account')


@section('styles')
<style>
	/* Styling Select Element */
	select {
		border: 1px solid #e8e8e8 !important;
		height: 50px !important;
		padding: 2px 20px !important;
	}

	select:focus {
		border: 1px solid #343538 !important;
	}

	.is-invalid {
		border-color: red !important;
	}

	.my-custom-btn {
		border: none;
    	background-color: #ff2f2f;
    	text-transform: uppercase;
    	font-weight: 600;
    	padding: 9px 25px;
    	color: #fff;
    	font-size: 13px;
	}

	.my-custom-btn:hover {
		background-color: #1f2226;
	}
</style>
@endsection

@section('content')
<div class="breadcrumb-area bg-gray">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li class="active">My account</li>
            </ul>
        </div>
    </div>
</div>
<!-- my account wrapper start -->
<div class="my-account-wrapper pt-120 pb-120">
    <div class="container">
        <div class="row">
        	@if(session('message'))
	        <div class="col-12">
	            <div class="alert alert-success bg-success text-white border-0 fade show" role="alert">
	                {!! session('message') !!}
	            </div>
	        </div>
	        @endif
            <div class="col-lg-12">
                <!-- My Account Page Start -->
                <div class="myaccount-page-wrapper">
                    <!-- My Account Tab Menu Start -->
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <div class="myaccount-tab-menu nav" role="tablist">
                                <a href="#dashboad" class="active" data-toggle="tab"><i class="fa fa-dashboard"></i>
                                    Dashboard</a>
                                <a href="#orders" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Orders</a>
                                <a href="#download" data-toggle="tab"><i class="fa fa-cloud-download"></i> Download</a>
                                <a href="#payment-method" data-toggle="tab"><i class="fa fa-credit-card"></i> Payment
                                    Method</a>
                                <a href="#address-edit" data-toggle="tab"><i class="fa fa-map-marker"></i> address</a>
                                <a href="#account-info" data-toggle="tab"><i class="fa fa-user"></i> Account Details</a>
                                <a onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="{{route('logout')}}"><i class="fa fa-sign-out"></i> Logout</a>
                            </div>
                            <!-- logout Form -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
				                @csrf
				            </form>
                        </div>
                        <!-- My Account Tab Menu End -->
                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-9 col-md-8">
                            <div class="tab-content" id="myaccountContent">
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Dashboard</h3>
                                        <div class="welcome">
                                            <p>Hello, <strong>{{auth()->user()->first_name}} {{auth()->user()->last_name}}</strong></p>
                                        </div>

                                        <p class="mb-0">From your account dashboard. you can easily check & view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="orders" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Orders</h3>
                                        @if(count(auth()->user()->orders) > 0)
	                                        <div class="myaccount-table table-responsive text-center">
	                                            <table class="table table-bordered">
	                                                <thead class="thead-light">
	                                                    <tr>
	                                                        <th>Order</th>
	                                                        <th>Date</th>
	                                                        <th>Status</th>
	                                                        <th>Total</th>
	                                                        <th>Action</th>
	                                                    </tr>
	                                                </thead>
	                                                <tbody>
	                                                	@foreach(auth()->user()->orders as $order)
	                                                    <tr>
	                                                        <td>{{$order->id}}</td>
	                                                        @if($order->orderStatus->status === 'Placed')
	                                                        <td>{{$order->created_at->format('d/m/Y H:i')}}</td>
	                                                        @elseif($order->orderStatus->status === 'Processed')
	                                                        <td>{{$order->processed_at->format('d/m/Y H:i')}}</td>
	                                                        @elseif($order->orderStatus->status === 'Shipped')
	                                                        <td>{{$order->shipped_at->format('d/m/Y H:i')}}</td>
	                                                        @elseif($order->orderStatus->status === 'Delivered')
	                                                        <td>{{$order->delivered_at->format('d/m/Y H:i')}}</td>
	                                                        @else
	                                                        <td>{{$order->cancelled_at->format('d/m/Y H:i')}}</td>
	                                                        @endif
	                                                        <td>{{$order->orderStatus->status}}</td>
	                                                        @php
	                                                        	$digitalProducts = [];
	                                                        	$total = 0;
	                                                        @endphp
	                                                        @foreach($order->products as $product)
	                                                        	@php
	                                                        		$total = $total + ( $product->pivot->quantity * $product->pivot->unit_price );
	                                                        		if($product->type_product === 'digital'){
	                                                        			$digitalProducts[] = $product;
	                                                        		}
	                                                        	@endphp
	                                                        @endforeach
	                                                        <td>${{$total}}</td>
	                                                        @if($order->cancelled_at === null)
	                                                        	<td>
	                                                        		<a onclick="event.preventDefault();$('#cancel-order-form').submit()" href="javascript:void(0)">Cancel</a>
	                                                        		<form class="d-none" id="cancel-order-form" method="POST" action="{{route('cancelOrder', $order->id)}}">
	                                                        			@csrf
	                                                        			@method('PATCH')
	                                                        		</form>
	                                                        	</td>
	                                                        @else
	                                                        	<td>No action</td>
	                                                        @endif
	                                                    </tr>
	                                                    
	                                                    @endforeach
	                                                </tbody>
	                                            </table>
	                                        </div>
                                        @else
                                        	<div class="alert alert-info bg-info text-white border-0" role="alert">
						                        No orders found.
						                    </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="download" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Downloads</h3>
                                        
                                        @if(isset($digitalProducts) && count($digitalProducts) > 0)
	                                        <div class="myaccount-table table-responsive text-center">
	                                            <table class="table table-bordered">
	                                                <thead class="thead-light">
	                                                    <tr>
	                                                        <th>Product</th>
	                                                        <th>Date</th>
	                                                        <th>Download</th>
	                                                    </tr>
	                                                </thead>
	                                                <tbody>
	                                                	@foreach($digitalProducts as $product)
	                                                    <tr>
	                                                        <td>{{$product->name}}</td>
	                                                        <td>{{$product->created_at->format('d/m/Y')}}</td>
	                                                        <td>
	                                                        	@foreach($product->files as $file)
	                                                        		<a download href="{{asset($file->source)}}" class="check-btn sqr-btn "><i class="fa fa-cloud-download"></i> Download File</a>
	                                                        	@endforeach
	                                                        </td>
	                                                    </tr>
	                                                 	@endforeach
	                                                </tbody>
	                                            </table>
	                                        </div>
	                                    @else
	                                    	<div class="alert alert-info bg-info text-white border-0" role="alert">
						                        You didn't buy any digital product.
						                    </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Payment Method</h3>
                                        <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Shipping Address</h3>
                                        <div class="mb-3">
                                            <p><strong>{{auth()->user()->first_name}} {{auth()->user()->last_name}}</strong></p>
                                            @if(auth()->user()->address !== null)
                                            	<p class="mb-1">{{auth()->user()->address->address}}, {{auth()->user()->address->city}}</p>
                                            	<p class="mb-1">{{auth()->user()->address->postal_code}}</p>
                                            @endif
                                            <p class="mb-1">{{auth()->user()->country->name}}</p>
                                            <p class="mb-1">Mobile: {{auth()->user()->phone_number}}</p>
                                        </div>
                                        <div class="address" style="margin-top: 2rem;">
											<form id="add-address-form" method="POST" action="@if(auth()->user()->address === null) {{route('addresses.store')}} @else {{route('addresses.update', auth()->user()->address->id)}} @endif">
												<div class="single-input-item mb-3">
										        	<label for="address">Address</label>
										        	<input class="@error('address') is-invalid @enderror" type="text" name="address" id="address" />
										        	@error('address')
										        		<small class="invalid-feedback">{{$message}}</small>
										        	@enderror
											    </div>
											    <div class="single-input-item mb-3">
											        <label for="city">City</label>
											        <input class="@error('city') is-invalid @enderror" type="text" name="city" id="city" />
											        @error('city')
										        		<small class="invalid-feedback">{{$message}}</small>
										        	@enderror
											    </div>
											    <div class="single-input-item mb-3">
											        <label for="postal_code">Postal Code</label>
											        <input class="@error('postal_code') is-invalid @enderror" type="text" name="postal_code" id="postal_code" />
											        @error('postal_code')
										        		<small class="invalid-feedback">{{$message}}</small>
										        	@enderror
											    </div>
                                        @if(auth()->user()->address)
                                        	<button class="my-custom-btn"><i class="fa fa-edit"></i> Edit Address</button>
                                        	@method('PUT')
                                        @else
              								<button class="my-custom-btn"><i class="fa fa-add"></i> Add address</button>  
                                        @endif
                                        		@csrf
											</form>
										</div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="account-info" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Account Details</h3>
                                        <div class="account-details-form">
                                            <form method="POST" action="{{route('settings.update')}}" >
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="first_name">First Name</label>
                                                            <input value="{{old('first_name')}}" class="@error('first_name') is-invalid @enderror" type="text" name="first_name" id="first_name" />
                                                            @error('first_name')
                                                            <small class="invalid-feedback">{{$message}}</small>
                                                        	@enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="last_name" class="required">Last Name</label>
                                                            <input value="{{old('last_name')}}" class="@error('last_name') is-invalid @enderror" type="text" name="last_name" id="last_name" />
                                                            @error('last_name')
                                                            <small class="invalid-feedback">{{$message}}</small>
                                                        	@enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="single-input-item">
                                                    <label for="phone_number" class="required">Phone Number</label>
                                                    <input value="{{old('phone_number')}}" placeholder="e.g : (xxx) xxxxxxxxx" type="text" class="@error('phone_number') is-invalid @enderror" name="phone_number" id="phone_number" />
                                                    @error('phone_number')
                                                    <small class="invalid-feedback">{{$message}}</small>
                                                	@enderror
                                                </div>
                                                <div class="single-input-item">
                                                    <label for="email" class="required">Email Address</label>
                                                    <input value="{{old('email')}}" type="email" name="email" id="email" />
                                                </div>
                                                <div class="single-input-item">
                                                    <label for="country" class="">Country</label>
                                                    <select class="@error('country_id') is-invalid @enderror" name="country_id" id="country" >
                                                    	@foreach($countries as $country)
                                                    		<option value="{{$country->id}}">{{$country->name}}</option>
                                                    	@endforeach
                                                    </select>
                                                    @error('country_id')
                                                    	<small class="invalid-feedback">{{$message}}</small>
                                                	@enderror
                                                </div>
                                                <fieldset>
                                                    <legend>Password change</legend>
                                                    <div class="single-input-item">
                                                        <label for="current_password">Current Password</label>
                                                        <input class="@error('current_password') is-invalid @enderror" type="password" name="current_password" id="current_password" />
                                                        @error('current_password')
                                                    	<small class="invalid-feedback">{{$message}}</small>
                                                		@enderror
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="password">New Password</label>
                                                                <input class="@error('password') is-invalid @enderror" type="password" name="password" id="password" />
                                                                @error('password')
			                                                    	<small class="invalid-feedback">{{$message}}</small>
			                                                	@enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="password_confirmation">Confirm Password</label>
                                                                <input type="password" name="password_confirmation" id="password_confirmation" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <div class="single-input-item">
                                                    <button class="check-btn sqr-btn ">Save Changes</button>
                                                </div>
                                                @csrf
                        						@method('PUT')
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- Single Tab Content End -->
                            </div>
                        </div> <!-- My Account Tab Content End -->
                    </div>
                </div> <!-- My Account Page End -->
            </div>
        </div>
    </div>
</div>
<!-- my account wrapper end -->
@endsection


@section('scripts')

@endsection