@extends('layouts.app')

@section('title', 'Orders')

@section('content')
<div class="container-fluid">
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Orders</h4>
        </div>
    </div>
</div>     
<!-- end page title --> 

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-xl-8">
                        <form class="row gy-2 gx-2 align-items-center justify-content-xl-start justify-content-between">
                            <div class="col-auto">
                                <div class="d-flex align-items-center">
                                    <label for="status-select" class="me-2">Status</label>
                                    <select class="form-select form-select-sm" id="status-select">
                                        <option selected value="">All</option>
                                        @foreach($orderStatuses as $status)
                                            <option value="{{$status->status}}">{{$status->status}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>                            
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="orders-datatable" class="table table-centered dt-responsive nowrap w-100">
                        <thead class="table-light">
                            <tr>
                                <th class="all">Order ID</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Order Status</th>
                                <th>Change Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td>
                                    <a href="apps-ecommerce-orders-details.html" class="text-body fw-bold">#{{$order->id}}</a>
                                </td>
                                <td>
                                    {{$order->created_at->format('d/m/Y H:i')}}
                                </td>
                                <td>
                                    ${{$order->products->map(function($product){ return $product->pivot->quantity * $product->pivot->unit_price; })->sum()}}
                                </td>
                                <td>
                                    @if($order->orderStatus->status === 'Shipped')
                                        <h5><span class="badge badge-info-lighten">Shipped</span></h5>
                                    @elseif($order->orderStatus->status === 'Processed')
                                        <h5><span class="badge badge-warning-lighten">Processed</span></h5>
                                    @elseif($order->orderStatus->status === 'Delivered')
                                        <h5><span class="badge badge-success-lighten">Delivered</span></h5>
                                    @elseif($order->orderStatus->status ==='Placed')
                                        <h5><span class="badge badge-primary-lighten">Placed</span></h5>
                                    @else
                                        <h5><span class="badge badge-danger-lighten">Cancelled</span></h5>
                                    @endif
                                </td>
                                <td>
                                    <select class="form-select form-select-sm" id="change-status" data-id="{{$order->id}}">
                                        @foreach($orderStatuses as $status)
                                            <option @if($order->orderStatus->status === $status->status) selected @endif value="{{$status->id}}">{{$status->status}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <a href="{{route('orders.show', $order->id)}}" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                    <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                           @empty
                                <div class="alert alert-info bg-info text-white border-0" role="alert">
                                    No orders found
                                </div>
                           @endforelse
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>
<!-- end row --> 

</div> <!-- container -->
@endsection


@section('scripts')
<script>
    $(function(){
        const table = $('#orders-datatable').DataTable();

        $('#status-select').on('change', function(){
            table
            .columns(3)
            .search(this.value)
            .draw();   
        });

        const url = "{{route('orders.index')}}";

        $('#change-status').change(function(){
            $.ajax({
                url : `${url}/${$(this).data('id')}/changeOrderStatus`,
                type: 'PATCH',
                data : { "status_id" : $(this).val(), "_token" : "{{csrf_token()}}" },
                success: function(response){
                    console.log({response});
                    $.NotificationApp.send("Change Status",response.message,"top-right","success","success");
                    setTimeout(function(){
                        window.location.href = url;
                    }, 1200);
                },
                error: function(error){
                    alert('Something went wrong, please try again');
                }
            });
        });
    });
</script>
@endsection