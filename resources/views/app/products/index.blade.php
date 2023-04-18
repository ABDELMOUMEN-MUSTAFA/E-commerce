@extends('layouts.app')

@section('title', 'Products')

@section('content')
<!-- Start Content-->
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Products</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        @if(session('message'))
                            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                {!! session('message') !!}
                            </div>
                        @endif
                        <table id="produts" class="table table-centered dt-responsive nowrap w-100">
                        <thead class="table-light">
                            <tr>
                                <th class="all">Product</th>
                                <th>Category</th>
                                <th>Added Date</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            @forelse($products as $product)
                            <tr>
                                <td>
                                    <img src="{{asset($product->photos->where('is_primary', true)->first()->source)}}" alt="product image" class="rounded me-3" height="48">
                                    <p class="m-0 d-inline-block align-middle font-16">
                                        <a href="{{ route('products.show', $product->id) }}" class="text-body">{{ $product->name }}</a>
                                        <br>
                                        <!-- 3ndak Tnsa -->
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                        <!-- End 3ndak Tnsa -->
                                    </p>
                                </td>
                                <td>
                                    @if($product->category_id !== null)
                                        {{ $product->category->name }}
                                    @else
                                        <h6 class="m-0"><span class="badge bg-danger">None</span></h6>
                                    @endif
                                </td>
                                <td>{{ $product->created_at->diffForHumans() }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->quantity_in_stock }}</td>
                                <td>
                                    <span class="badge bg-primary rounded-pill">{{ ucfirst($product->type_product) }}</span>
                                </td>
                                <td>
                                    <form method="POST" action="{{route('products.toggleActive', $product->id)}}">
                                            <input class="status" type="checkbox" id="status-{{$product->id}}" @if($product->is_active === true) checked @endif data-switch="none"/>
                                            <label for="status-{{$product->id}}" data-on-label="" data-off-label=""></label>
                                            @csrf
                                            @method('PATCH')
                                    </form>
                                </td>
                                <td class="table-action">
                                    <a href="{{route('photos.create', $product->id)}}" class="action-icon"> <i class="dripicons-photo-group"></i></a>
                                    <a href="{{route('products.show', $product->id)}}" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                    <a onclick="showModalToConfirmDelete({{$product->id}});" href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                    @if($product->type_product === 'digital')
                                        <a href="{{route('files.create', $product->id)}}" class="action-icon"> <i class="mdi mdi-file"></i></a>
                                    @endif
                                    <a href="{{route('productVariants.create', $product->id)}}" class="action-icon"><i class="mdi mdi-selection-multiple"></i></a>
                                </td>
                            </tr>
                            @empty
                                <div class="alert alert-info bg-info text-white border-0" role="alert">
                                    No products found
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
</div> <!-- content -->
@endsection

@section('delete_modal_title', 'Removing Product')
@section('delete_modal_body', 'Are you sure ?')

@include('layouts.deleteModal')


@section('scripts')
<script>
    const url = '{{route("products.index")}}';
    // Event Handler Deletion
    function showModalToConfirmDelete(id) {
        $('#delete-modal').modal('show');
        $('#delete-form').attr('action', `${url}/${id}`);
    }

    // because there is no submit button in the form (toggle)
    $(function () {
        $('#produts').DataTable();
        
        // Toggle Product Status
        $('.status').click(function(e) {
            $(this).parent().submit();
        });
    });
</script>
@endsection