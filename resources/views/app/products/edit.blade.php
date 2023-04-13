@extends('layouts.index')

@section('title', 'Edit Product')

@section('styles')
<!-- SimpleMDE css -->
<link href="{{ asset('css/vendor/simplemde.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Product</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <form action="{{ route('products.update', $product->id) }}" method="POST">
							<div class="mb-3">
							    <label for="name" class="form-label">Name</label>
							    <input name="name" value="{{ $product->name }}" type="text" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Entre product name">
							    @error('name')
							    	<div class="invalid-feedback">{{ $message }}</div>
							    @enderror
							</div>
							<div class="mb-3">
								<label for="price" class="form-label">Price</label>
							    <input name="price" value="{{ $product->price }}" type="text" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="Entre product price" data-toggle="input-mask" data-mask-format="0000000" data-reverse="true">
							    @error('price')
							    	<div class="invalid-feedback">{{ $message }}</div>
							    @enderror
							</div>
							<div class="mb-3">
								<label for="quantity" class="form-label">Quantity</label>
							    <input name="quantity_in_stock" value="{{ $product->quantity_in_stock }}" type="text" id="quantity" class="form-control @error('quantity_in_stock') is-invalid @enderror" placeholder="Entre product quantity in stock" data-toggle="input-mask" data-mask-format="000000000" data-reverse="true">
							    @error('quantity_in_stock')
							    	<div class="invalid-feedback">{{ $message }}</div>
							    @enderror
							</div>
							<div class="mb-3 d-flex gap-3">
								<div>
									<input type="radio" id="physical-product" name="type_product" class="form-check-input @error('type_product') is-invalid @enderror" value="physical" @if($product->type_product === 'physical') checked @endif >
						    		<label class="form-check-label" for="physical-product">Physical Product</label>
								</div>
								<div>
						    		<input type="radio" id="digital-product" name="type_product" class="form-check-input @error('type_product') is-invalid @enderror" value="digital" @if($product->type_product === 'digital') checked @endif>
						    		<label class="form-check-label" for="digital-product">Digital Product</label>
								</div>
							</div>
							</div>
							<div class="mb-3">
							    <label for="category" class="form-label">Category</label>
							    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" id="category">
							    	<option disabled selected>---- Select Category ----</option>
							    	@foreach($categories as $category)
							    	<option @if($product->category_id === $category->id) selected  @endif value="{{ $category->id }}">
							    		{{ $category->name }}
							    	</option>
							    	@endforeach
							    </select>
							    @error('category_id')
							    	<div class="invalid-feedback">{{ $message }}</div>
							    @enderror
							</div>		
							<div class="mb-3">
							    <label for="description" class="form-label">Description</label>
							    <textarea id="description" placeholder="Entre product description" class="form-control @error('description') is-invalid @enderror" name="description" rows="5">{{ $product->description }}</textarea>
							    @error('description')
							    	<div class="invalid-feedback">{{ $message }}</div>
							    @enderror
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
<!-- SimpleMDE js -->
<script src="{{ asset('js/vendor/simplemde.min.js') }}"></script>
<!-- SimpleMDE demo -->
<script src="{{ asset('js/pages/simplemde.js') }}"></script>
@endsection
