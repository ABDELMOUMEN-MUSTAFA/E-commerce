@extends('layouts.index')

@section('title', 'Product Details')

@section('content')
<!-- Start Content-->
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Product Details</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                	@if(session('message'))
                        <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {!! session('message') !!}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-5">
                            <!-- Product image -->
                            <a href="javascript: void(0);" class="text-center d-block mb-4">
                                <img src="{{ asset($product->photos->where('is_primary', true)[0]->source) }}" class="img-fluid" style="max-width: 280px;" alt="Product-img">
                            </a>

                            <div class="d-lg-flex d-none justify-content-center">
                                <a href="javascript: void(0);">
                                    <img src="{{ asset('images/products/product-1.jpg') }}" class="img-fluid img-thumbnail p-2" style="max-width: 75px;" alt="Product-img">
                                </a>
                                <a href="javascript: void(0);" class="ms-2">
                                    <img src="{{ asset('images/products/product-6.jpg') }}" class="img-fluid img-thumbnail p-2" style="max-width: 75px;" alt="Product-img">
                                </a>
                                <a href="javascript: void(0);" class="ms-2">
                                    <img src="{{ asset('images/products/product-3.jpg') }}" class="img-fluid img-thumbnail p-2" style="max-width: 75px;" alt="Product-img">
                                </a>
                                <a href="javascript: void(0);" class="ms-2">
                                    <img src="{{ asset('images/products/product-3.jpg') }}" class="img-fluid img-thumbnail p-2" style="max-width: 75px;" alt="Product-img">
                                </a>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-7">
                            <div class="ps-lg-4">
                                <!-- Product title -->
                                <h3 class="mt-0">{{$product->name}} <a href="{{route('products.edit', $product->id)}}" class="text-muted"><i class="mdi mdi-square-edit-outline ms-2"></i></a> </h3>
                                <p class="mb-1">Added Date: {{$product->created_at->format('m/d/Y')}}</p>
                                <p class="font-16">
                                    <span class="text-warning mdi mdi-star"></span>
                                    <span class="text-warning mdi mdi-star"></span>
                                    <span class="text-warning mdi mdi-star"></span>
                                    <span class="text-warning mdi mdi-star"></span>
                                    <span class="text-warning mdi mdi-star"></span>
                                </p>

                                <!-- Product stock -->
                                <div class="mt-3">
                                	@if($product->quantity_in_stock > 0)
                                    	<h4><span class="badge badge-success-lighten">Instock</span></h4>
                                	@else
                                		<h4><span class="badge badge-danger-lighten">Out of stock</span></h4>
                                	@endif
                                </div>

                                <!-- Product description -->
                                <div class="mt-4">
                                    <h6 class="font-14">Retail Price:</h6>
                                    <h3> {{ $product->price }}</h3>
                                </div>

                                <!-- Quantity -->
                                <div class="mt-4">
                                    <h6 class="font-14">Quantity</h6>
                                    <div class="d-flex">
                                       <div class="mb-3">
                                       	<form method="POST" action="{{route('products.incrementStock', $product->id)}}">
                                       		<div class="mb-3">
                                       			<label class="form-label">Note that the value you provide will increments the stock by it</label>
										    	<input name="newStock" class="@error('newStock') is-invalid @enderror mb-1"  data-toggle="touchspin" value="1" type="text" data-bts-button-down-class="btn btn-danger" data-bts-button-up-class="btn btn-info">
										    	@error('newStock')
							    					<small class="text-danger">{{ $message }}</small>
							    				@enderror
                                       		</div>
										    <button class="btn btn-primary">Add to stock</button>
										    @csrf
										    @method('PATCH')
										</form>
										</div>
                                    </div>
                                </div>
                    
                                <!-- Product description -->
                                <div class="mt-4">
                                    <h6 class="font-14">Description:</h6>
                                    <p>{{$product->description}}</p>
                                </div>

                                <!-- Product information -->
                                <div class="mt-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h6 class="font-14">Available Stock:</h6>
                                            <p class="text-sm lh-150">{{$product->quantity_in_stock}}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="font-14">Number of Orders:</h6>
                                            <p class="text-sm lh-150">{{ $product->orders->count() }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="font-14">Revenue:</h6>
                                            <p class="text-sm lh-150">{{$revenue}}</p>
                                        </div>
                                    </div>
                                </div>
                        </div> <!-- end col -->
                    </div> <!-- end row-->

                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-centered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Outlets</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Revenue</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ASOS Ridley Outlet - NYC</td>
                                    <td>$139.58</td>
                                    <td>
                                        <div class="progress-w-percent mb-0">
                                            <span class="progress-value">478 </span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 56%;" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$1,89,547</td>
                                </tr>
                                <tr>
                                    <td>Marco Outlet - SRT</td>
                                    <td>$149.99</td>
                                    <td>
                                        <div class="progress-w-percent mb-0">
                                            <span class="progress-value">73 </span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 16%;" aria-valuenow="16" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$87,245</td>
                                </tr>
                                <tr>
                                    <td>Chairtest Outlet - HY</td>
                                    <td>$135.87</td>
                                    <td>
                                        <div class="progress-w-percent mb-0">
                                            <span class="progress-value">781 </span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 72%;" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$5,87,478</td>
                                </tr>
                                <tr>
                                    <td>Nworld Group - India</td>
                                    <td>$159.89</td>
                                    <td>
                                        <div class="progress-w-percent mb-0">
                                            <span class="progress-value">815 </span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 89%;" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$55,781</td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                    
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- end row-->
    
</div> <!-- container -->

</div> <!-- content -->
@endsection