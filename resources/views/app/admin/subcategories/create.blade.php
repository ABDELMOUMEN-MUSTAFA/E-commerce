@extends('layouts.admin.app')

@section('title', 'Add Subcategory')

@section('content')
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Add Subcategory</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <form action="{{ route('subcategories.store') }}" method="POST">
							<div class="mb-3">
							    <label for="name" class="form-label">Name</label>
							    <input name="name" value="{{ old('name') }}" type="text" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Entre subcategoty name">
							    @error('name')
							    	<div class="invalid-feedback">{{ $message }}</div>
							    @enderror
							</div>
							<div class="mb-3">
							    <label for="category" class="form-label">Category</label>
							    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" id="category">
							    	<option disabled selected>---- Select Category ----</option>
							    	@foreach($categories as $category)
							    	<option value="{{ $category->id }}">
							    		{{ $category->name }}
							    	</option>
							    	@endforeach
							    </select>
							    @error('category_id')
							    	<div class="invalid-feedback">{{ $message }}</div>
							    @enderror
							</div>
							<button class="btn btn-success">Add Subcategory</button>
						    @csrf
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


