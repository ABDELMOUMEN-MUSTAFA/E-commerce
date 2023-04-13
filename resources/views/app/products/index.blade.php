@extends('layouts.index')

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
                                    <img src="{{$product->photos->where('is_primary', true)[0]->source }}" alt="product image" class="rounded me-3" height="48">
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
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->created_at->diffForHumans() }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->quantity_in_stock }}</td>
                                <td>
                                    <span class="badge bg-primary rounded-pill">{{ $product->type_product }}</span>
                                </td>
                                <td>
                                    <form id="toggle-form" method="POST" action="{{route('products.toggleActive', $product->id)}}">
                                            <input type="checkbox" id="status" @if($product->is_active === true) checked @endif data-switch="none"/>
                                            <label for="status" data-on-label="" data-off-label=""></label>
                                            @csrf
                                            @method('PATCH')
                                    </form>
                                </td>
                                <td class="table-action">
                                    <a href="{{route('products.show', $product->id)}}" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                    <a onclick="showModalToConfirmDelete();" data-id="{{$product->id}}" href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
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

@section('modalTitle', 'Removing Product')
@section('modalBody', 'Are you sure ?')

@include('layouts.deleteModal')


@section('scripts')
<script>
    $('#produts').DataTable();

    // Event Handler Deletion
    function showModalToConfirmDelete() {
        $('#delete-modal').modal('show')
        $('#delete-form').attr('action', `${url}/${$(this).data('id')}`);
    }

    $(function () {
        const url = '{{route("products.index")}}';
        
        // Toggle Product Status
        $('#status').click(function(e) {
            $('#toggle-form').submit();
        });
    });
</script>
@endsection