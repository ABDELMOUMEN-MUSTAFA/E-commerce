@extends('layouts.admin.app')

@section('title', 'Product Details')

@section('styles')
<style>

</style>
@endsection

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
                            <div class="text-center mb-4">
                                <img src="{{ asset($product->photos->where('is_primary', true)->first()->source) }}" class="img-fluid rounded" style="max-width: 280px;" alt="Product-img">
                            </div>
                            <div class="d-flex justify-content-center gap-1">
                                <div class="row">
                                    @foreach($product->photos->where('is_primary', false) as $photo)
                                    <div class="col-6 mb-2">
                                        <div class="image-container text-center">
                                            <img class="img-fluid img-thumbnail p-1 image" style="max-width: 120px;" src="{{ asset($photo->source) }}" alt="product image" />
                                            <div class="d-flex justify-content-center gap-1 mt-1">
                                                <form method="POST" action="{{route('photos.destroy', $photo->id)}}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger btn-rounded"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-custom-class="custom-tooltip"
                                                data-bs-title="Remove this one">
                                                <i class="mdi mdi-image-remove" data-bs-custom-class="custom-tooltip"></i>
                                                </button>
                                                </form>
                                                <form method="POST" action="{{route('photos.makePhotoPrimary', ['product' => $product->id, 'photo' => $photo->id])}}">
                                                    @method('PATCH')
                                                    @csrf
                                                    <button class="btn btn-sm btn-info btn-rounded"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Make it as primary">
                                                <i class="mdi mdi-image-frame"></i>
                                                </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="col-12 my-3 my-lg-0">
                                        <div class="d-grid">
                                            <a href="{{ route('photos.create', $product->id) }}" class="btn btn-dark btn-rounded"><i class="mdi mdi-image-multiple"></i> Add More Photos</a>
                                        </div>
                                    </div>
                                </div>
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
                                <div class="mt-4 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="font-14">Retail Price:</h6>
                                        <h3> {{ $product->price }}</h3>
                                    </div>
                                    <div>
                                        <a class="btn btn-dark" href="{{route('promotions.create', $product->id)}}"><i class="mdi mdi-magnet"></i> Add Promotion</a>
                                    </div>
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
                    <hr />
                    @if($product->type_product === 'physical')
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5>Product Variants</h5>
                            <a href="{{route('productVariants.create', $product->id)}}" class="btn btn-dark"><i class="mdi mdi-selection-multiple"></i> Add Variants</a>
                        </div>
                        @if(count($product->productVariants) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-centered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Variant Name</th>
                                        <th>Price</th>
                                        <th>Color</th>
                                        <th>Sizes</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product->productVariants as $variant)
                                    <tr>
                                        <td>{{$variant->name}}</td>
                                        <td>{{$variant->price}}</td>
                                        <td class="text-center">
                                            <span class="d-inline-block rounded-circle" style="width: 20px;height: 20px;background-color: {{$variant->color->name}};@if($variant->color->name == 'white') border: 1px solid #555; @endif"></span>
                                        </td>
                                        <td>
                                            @foreach($variant->sizes as $size)
                                                <h3 class="badge badge-info-lighten">{{$size->name}}</h3>
                                            @endforeach
                                        </td>
                                        <td class="d-flex justify-content-center">
                                            <div class="btn-group dropdown">
                                                <a href="#" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-xs" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="{{route('productVariants.edit', $variant->id)}}" class="dropdown-item"><i class="mdi mdi-pencil me-2 text-muted vertical-middle"></i>Edit</a>
                                                    <button data-id="{{$variant->id}}" class="dropdown-item delete-variant"><i class="mdi mdi-delete me-2 text-muted vertical-middle"></i>Remove</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->
                        @else
                            <div class="alert alert-info bg-info text-white border-0" role="alert">
                                No variants for this product
                            </div>
                        @endif
                    @else
                        @forelse($product->files as $file)
                            @if ($loop->first)
                            <h5 class="mb-2">Attached Files</h5>
                            <div class="row mx-n1 g-0">
                            @endif
                            <div class="col-xxl-3 col-lg-6">
                                <div class="card m-1 shadow-none border">
                                    <div class="p-2">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar-sm">
                                                    <span class="avatar-title bg-light text-secondary rounded">
                                                        <i class="mdi mdi-file font-16"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col ps-0">
                                                <span data-id="{{$file->id}}" class="text-muted fw-bold">{{$file->name}}</span>
                                                <p class="mb-0 font-13">{{$file->size}}</p>
                                            </div>
                                            <div class="col-auto">
                                                <div class="btn-group dropdown">
                                                    <a href="#" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-xs" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <button class="dropdown-item rename" data-id="{{$file->id}}"><i class="mdi mdi-pencil me-2 text-muted vertical-middle"></i>Rename</button>
                                                        <a class="dropdown-item" href="{{route('files.download', $file->id)}}"><i class="mdi mdi-download me-2 text-muted vertical-middle"></i>Download</a>
                                                        <form method="POST" action="{{route('files.destroy', $file->id)}}">
                                                        <button class="dropdown-item"><i class="mdi mdi-delete me-2 text-muted vertical-middle"></i>Remove</button>
                                                        @csrf
                                                        @method('DELETE')
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end row -->
                                    </div> <!-- end .p-2-->
                                </div> <!-- end col -->
                            </div> <!-- end col-->
                            @if ($loop->last)
                                </div> <!-- end row-->
                            @endif
                        @empty
                            <div class="alert alert-info bg-info text-white border-0" role="alert">
                                No file attached
                            </div>
                        @endforelse
                    @endif
                    <hr />
                        <div class="d-flex justify-content-between mb-2">
                            <h5>Product Promotions</h5>
                            @if($product->promotions->min('end_date') < now())
                                <form method="POST" action="{{route('promotions.clearExpired', $product->id)}}">
                                    <button class="btn btn-link text-dark fw-bolder"><small>Clear all expired</small></button>
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endif
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-centered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Discount</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($product->promotions->sortByDesc('end_date') as $promotion)
                                        @php($maxEndDate = $product->promotions->max('end_date'))
                                        <tr class="@if($promotion->end_date >= now() && $promotion->end_date <= $maxEndDate) bg-success-lighten @endif">
                                            <td>{{$promotion->discount}}%</td>
                                            <td>{{$promotion->start_date->format('d/m/Y')}}</td>
                                            <td>{{$promotion->end_date->format('d/m/Y')}}</td>
                                            <td>
                                                @if($promotion->end_date >= now())
                                                    @if($promotion->end_date <= $maxEndDate)
                                                        <!-- Running -->
                                                        <span class="badge badge-success-lighten">Running</span>
                                                    @else
                                                        <!-- Pending -->
                                                        <span class="badge badge-warning-lighten">Pending</span>
                                                    @endif
                                                @else
                                                    <!--  Expired -->
                                                    <span class="badge badge-danger-lighten">Expired</span>
                                                @endif
                                            </td>
                                            <td class="d-flex justify-content-center">

                                                <div class="btn-group dropdown">
                                                    <a href="#" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-xs" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a href="{{route('promotions.edit', $promotion->id)}}" class="dropdown-item"><i class="mdi mdi-pencil me-2 text-muted vertical-middle"></i>Edit</a>
                                                        <form method="POST" action="{{route('promotions.destroy', $promotion->id)}}">
                                                            <button class="dropdown-item"><i class="mdi mdi-delete me-2 text-muted vertical-middle"></i>Remove</button>
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-info bg-info text-white border-0" role="alert">
                                            No promotions
                                        </div>
                                    @endforelse
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

@section('edit_model_id', 'rename-modal')
@section('edit_model_title', 'Rename File')
@section('edit_model_body')
<form id="rename-file" method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Rename</label>
        <input name="name" type="text" id="name" class="form-control" placeholder="Entre categoty name">
        <div class="invalid-feedback name"></div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary">Save changes</button>
    </div>
    @csrf
</form>
@endsection

@include('layouts.admin.editModal')

@section('delete_model_title', 'Delete Variant')
@section('delete_model_body')
<p>Are you sure you want to delete this variant ?</p>
@endsection


@include('layouts.admin.deleteModal')

@section('scripts')
<script>
$(function(){
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    // URL ENDPOINT
    const renameFileURL = "{{route('files.rename', '')}}";
    const deleteVariantURL = "{{route('productVariants.destroy', '')}}";

    // Hanlde Delete Variant
    $('.delete-variant').click(function(){
        $('#delete-modal').modal('show')
        $('#delete-form').attr('action', `${deleteVariantURL}/${$(this).data('id')}`);
    });
        
    let fileID;
    $('.rename').click(function () {
        $('#rename-modal').modal('show');
        fileID = $(this).data('id');
    });

    $('#rename-file').submit(function(event){
        event.preventDefault();
        // File name field
        const $name = $('#name');
        // invalid-feedback for file name field
        const $feedbackName = $('.invalid-feedback.name');

        const formData = $(this).serializeArray();

        $.ajax({
            url : `${renameFileURL}/${fileID}`,
            type : 'PATCH',
            data : formData,
            success: function(response){
                $('#rename-modal').modal('hide');
                $.NotificationApp.send("Rename File",response.message,"top-right","success","success")
                $(`span[data-id=${fileID}]`).text(formData[0].value);
                $name.val('');
                $name.removeClass('is-invalid');
                $feedbackName.html('');
            },
            error: function(data){
                const response = JSON.parse(data.responseText);
                if(!$name.hasClass('is-invalid')){
                    $name.addClass('is-invalid');
                }
                $feedbackName.html(response.errors.name);
            }
        });
    });
});
</script>
@endsection