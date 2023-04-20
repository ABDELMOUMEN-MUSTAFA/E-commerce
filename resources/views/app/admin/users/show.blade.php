@extends('layouts.admin.app')

@section('title', 'User Profil')

@section('content')
<!-- Start Content-->
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Profile</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 


    <div class="row">
        <div class="col-sm-12">
            <!-- Profile -->
            <div class="card bg-primary">
                <div class="card-body profile-user-box">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="avatar-lg">
                                        <img src="{{asset($user->avatar)}}" alt="" class="rounded-circle img-thumbnail">
                                    </div>
                                </div>
                                <div class="col">
                                    <div>
                                        <h4 class="mt-1 mb-1 text-white">{{$user->first_name}} {{$user->last_name}}</h4>
                                        @if($user->is_admin)
                                            <p class="font-13 text-black-50 badge bg-info">Admin</p>
                                        @else
                                            <p class="font-13 text-black-50 badge bg-info">Customer</p>
                                        @endif

                                        <ul class="mb-0 list-inline text-light">
                                            <li class="list-inline-item me-3">
                                                <h5 class="mb-1">{{$user->created_at->format('d/m/Y')}}</h5>
                                                <p class="mb-0 font-13 text-white-50">Account Created</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col-->

                        <div class="col-sm-4">
                            <div class="text-center mt-sm-0 mt-3 text-sm-end">
                                <a href="{{route('users.edit', $user->id)}}" class="btn btn-light">
                                    <i class="mdi mdi-account-edit me-1"></i> Edit Profile
                                </a>
                            </div>
                        </div> <!-- end col-->
                    </div> <!-- end row -->

                </div> <!-- end card-body/ profile-user-box-->
            </div><!--end profile/ card -->
        </div> <!-- end col-->
    </div>
    <!-- end row -->


    <div class="row">
        <div class="col-xl-4">
            <!-- Personal-Information -->
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-3">User Information</h4>
                    <div class="text-start">
                        <p class="text-muted"><strong>Email :</strong> <span class="ms-2">{{$user->email}}</span></p>
                        <p class="text-muted"><strong>Location :</strong> <span class="ms-2">{{$user->country->name}}</span></p>
                        <p class="text-muted"><strong>IP Address :</strong> <span class="ms-2">{{$user->ip_address}}</span></p>
                    </div>
                </div>
            </div>
            <!-- Personal-Information -->

            <!-- Toll free number box-->
            <div class="card text-white bg-info overflow-hidden">
                <div class="card-body">
                    <div class="toll-free-box text-center">
                        <h4> <i class="mdi mdi-deskphone"></i> Phone number : {{$user->phone_number}}</h4>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
            <!-- End Toll free number box-->
        </div> <!-- end col-->

        <div class="col-xl-8">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card tilebox-one">
                        <div class="card-body">
                            <i class="dripicons-basket float-end text-muted"></i>
                            <h6 class="text-muted text-uppercase mt-0">Orders</h6>
                            <h2 class="m-b-20">{{count($user->orders)}}</h2>
                        </div> <!-- end card-body-->
                    </div> <!--end card-->
                </div><!-- end col -->

                <div class="col-sm-4">
                    <div class="card tilebox-one">
                        <div class="card-body">
                            <i class="dripicons-box float-end text-muted"></i>
                            <h6 class="text-muted text-uppercase mt-0">Revenue</h6>
                            @if(isset($revenue[0]->revenue))
                                <h2 class="m-b-20">$<span>{{$revenue[0]->revenue}}</span></h2>
                            @else
                                <h2 class="m-b-20">$<span>0</span></h2>
                            @endif
                        </div> <!-- end card-body-->
                    </div> <!--end card-->
                </div><!-- end col -->

                <div class="col-sm-4">
                    <div class="card tilebox-one">
                        <div class="card-body">
                            <i class="dripicons-jewel float-end text-muted"></i>
                            <h6 class="text-muted text-uppercase mt-0">Products Bought</h6>
                            @if(isset($boughtProducts[0]->boughtProducts))
                                <h2 class="m-b-20">{{$boughtProducts[0]->boughtProducts}}</h2>
                            @else
                                <h2 class="m-b-20"><span>0</span></h2>
                            @endif
                        </div> <!-- end card-body-->
                    </div> <!--end card-->
                </div><!-- end col -->

            </div>
            <!-- end row -->


            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Bought Products Details</h4>

                    <div class="table-responsive">
                        <table class="table table-hover table-centered mb-0">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                    <th>Order Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($boughtProductsDetails as $product)
                                    <tr>
                                        <td>{{$product->name}}</td>
                                        <td>${{$product->unit_price}}</td>
                                        <td><span class="badge bg-primary">{{$product->quantity}} Pcs</span></td>
                                        <td>${{$product->amount}}</td>
                                        <td>{{ Carbon\Carbon::parse($product->created_at)->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <div class="alert alert-info bg-info text-white border-0" role="alert">
                                        This customer didn't buy any product yet.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div> <!-- end table responsive-->
                </div> <!-- end col-->
            </div> <!-- end row-->

        </div>
        <!-- end col -->

    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Products in Shopping cart</h4>

                    <div class="table-responsive">
                        <table class="table table-hover table-centered mb-0">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Date Added</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($user->products as $product)
                                    <tr>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->price}}</td>
                                        <td><span class="badge bg-primary">{{$product->pivot->quantity}} Pcs</span></td>
                                        <td>{{ $product->pivot->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <div class="alert alert-info bg-info text-white border-0" role="alert">
                                        Customer's shopping cart is empty.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div> <!-- end table responsive-->
                </div> <!-- end col-->
            </div> <!-- end row-->
        </div>
    </div>
    <!-- end row -->
    
</div> <!-- container -->
@endsection
