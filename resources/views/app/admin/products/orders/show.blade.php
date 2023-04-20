@extends('layouts.admin.app')

@section('title', 'Order Details')

@section('content')
<!-- Start Content-->
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Order Details</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10 col-sm-11">
            <!-- Processed Shipped Delivered Cancelled Placed -->
            <div class="horizontal-steps mt-4 mb-4 pb-5" id="tooltip-container">
                <div class="horizontal-steps-content">    
                    @foreach($orderStatuses as $status)
                        @if ($order->orderStatus->status === 'Cancelled')
                            <div class="step-item">
                                <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$order->created_at->toDayDateTimeString()}}">Placed</span>
                            </div>
                            <div class="step-item current" style="color: red;">
                                <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$order->cancelled_at->toDayDateTimeString()}}">Cancelled</span>
                            </div>
                            @break
                        @endif
                        @if($status->status === 'Cancelled')
                            @break
                        @endif
                        <div class="step-item @if($status->status === $order->orderStatus->status) current @endif">
                            <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="
                            @if($status->status === 'Placed')
                                {{$order->created_at->toDayDateTimeString()}}
                            @endif
                            @if($status->status === 'Processed')
                                {{$order->processed_at->toDayDateTimeString()}}
                            @endif
                            @if($status->status === 'Shipped')
                                {{$order->shipped_at->toDayDateTimeString()}}
                            @endif
                            @if($status->status === 'Delivered')
                                {{$order->delivered_at->toDayDateTimeString()}}
                            @endif
                            ">{{$status->status}}</span>
                        </div>
                    @endforeach
                </div>
                <div class="process-line" style="width: {{$order->orderStatus->progress}};"></div>
            </div>
        </div>
    </div>
    <!-- end row -->    
    
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Items from Order #{{$order->id}}</h4>

                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->products as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->pivot->quantity}}</td>
                                    <td>${{$product->pivot->unit_price}}</td>
                                    <td>${{$product->pivot->quantity * $product->pivot->unit_price}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->

                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Shipping Information</h4>
                    
                    <div class="mb-0 font-14 address-lg">
                        <p class="mb-2">Full Name : <strong>{{$order->user->first_name}} {{$order->user->last_name}}</strong></p>
                        <p class="mb-2">Country : <strong>{{$order->user->country->name}}</strong></p>
                        <p class="mb-2">City : <strong>{{$order->user->address->city}}</strong></p>
                        <p class="mb-2">Address : <strong>{{$order->user->address->address}}</strong></p>
                        <p class="mb-2">Postal Code : <strong>{{$order->user->address->postal_code}}</strong></p>
                        <p class="mb-0">Phone number : <strong>{{$order->user->phone_number}}</strong></p>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->
    
</div> <!-- container -->
@endsection
