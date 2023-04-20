@extends('layouts.admin.app')

@section('title', 'Edit Variant')

@section('styles')
<link href="{{ asset('css/vendor/boxed-check.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Variant</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <form action="{{ route('productVariants.update', $productVariant->id) }}" method="POST">
                        	<div class="mb-3">
							    <label for="product-name" class="form-label">You are about to add variantion for the product below</label>
							    <input value="{{ $productVariant->product->name }}" type="text" id="product-name" class="form-control" />
							</div>
							<div class="mb-3">
							    <label for="name" class="form-label">Variant Name</label>
							    <input name="name" value="{{$productVariant->name}}" type="text" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Entre variant name" />
							    @error('name')
							    	<div class="invalid-feedback">{{ $message }}</div>
							    @enderror
							</div>
							<div class="mb-3">
								<label for="price" class="form-label">Price</label>
							    <input name="price" value="{{ $productVariant->price }}" type="text" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="Entre product price" data-toggle="input-mask" data-mask-format="000000000.00" data-reverse="true">
							    @error('price')
							    	<div class="invalid-feedback">{{ $message }}</div>
							    @enderror
							</div>
							<div class="mb-3">
								<label for="product" class="form-label d-block @error('color_id') text-danger @enderror">Colors</label>
						    	<div class="boxed-check-group boxed-check-default">
								    @foreach($colors as $color)
						    		<label class="boxed-check boxed-check-inline">
								        <input data-color="{{$color->name}}" id="color-{{$color->name}}"  value="{{$color->id}}" class="boxed-check-input" type="radio" name="color_id">						      
								        <div class="boxed-check-label">{{ucfirst($color->name)}}</div>
								    </label>
							    	@endforeach
							    	@error('color_id')
						    			<small class="text-danger d-block mt-1">{{ $message }}</small>
						    		@enderror
								</div>
							</div>	
							<div class="mb-3">
								<label for="product" class="form-label d-block @error('sizes') text-danger @enderror @error('sizes.*') text-danger @enderror">Sizes</label>
								<div class="boxed-check-group boxed-check-default">
								    @foreach($sizes as $size)
						    		<label class="boxed-check boxed-check-inline">
								        <input id="size-{{$size->name}}"  value="{{$size->id}}" class="boxed-check-input" type="checkbox" name="sizes[]">
								        <div class="boxed-check-label">{{ucfirst($size->name)}}</div>
								    </label>
							    	@endforeach
							    	@error('sizes')
							    		<small class="text-danger d-block mt-1">{{ $message }}</small>
							    	@enderror
							    	@error('sizes.*')
							    		<small class="text-danger d-block mt-1">{{ $message }}</small>
							    	@enderror
								</div>
							</div>		
							<button class="btn btn-success">Save changes</button>
						    @csrf
						    @method('PUT')
						</form>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->        
    
</div> <!-- container -->

</div> <!-- content -->
@endsection


@section('scripts')
<script>
	// Colors in checkboxes
	$('[name="color_id"]').change(function () {
		const choosingColor = $(this).data('color').toLowerCase();
		$('[name="color_id"]').each(function(index, checkbox){
			if(checkbox.checked === true){
				if(choosingColor === 'white'){
					$(this).next().css({backgroundColor : choosingColor, color: '#121111'});
				}else{
					$(this).next().css({backgroundColor : choosingColor, borderColor : choosingColor, color: '#ced4da'});
				}
			}else{
				$(this).next().css({backgroundColor : '#fff', borderColor: '#ced4da', color: '#6c757d'});
			}
		});
	});
</script>
@endsection