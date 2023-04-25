@extends('layouts.admin.app')

@section('title', 'Edit Collection')

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Collection</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <form action="{{ route('updateCollection', $collection->id) }}" method="POST" enctype="multipart/form-data">
							<div class="mb-3">
							    <label for="type" class="form-label">Type (big or small)</label>
							    <input name="type" value="{{ $collection->type }}" type="text" id="type" class="form-control @error('type') is-invalid @enderror" placeholder="Entre collection type">
							    @error('type')
							    	<div class="invalid-feedback">{{ $message }}</div>
							    @enderror
							</div>
							<div class="mb-3">
							    <label for="title" class="form-label">Title</label>
							    <input name="title" value="{{ $collection->title }}" type="text" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Entre collection title">
							    @error('title')
							    	<div class="invalid-feedback">{{ $message }}</div>
							    @enderror
							</div>
							<div class="mb-3">
							    <label for="description" class="form-label">Description</label>
							    <textarea placeholder="Entre collection description" class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5">{{ $collection->description }}</textarea>
							    @error('description')
							    	<div class="invalid-feedback">{{ $message }}</div>
							    @enderror
							</div>
							@if(!empty($collection->photo))
							<div class="mb-2 text-center">
								<img height="50" src="{{ asset($collection->photo) }}" alt="collection photo" class="rounded">
							</div>
							@endif
							<div class="mb-3">
							    <label for="photo" class="form-label">Photo</label>
							    <input type="file" name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror">
							    @error('photo')
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