@extends('layouts.admin.app')

@section('title', 'Add Color')

@section('content')
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Add Color</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <form action="{{ route('colors.store') }}" method="POST">
							<div class="mb-3">
							    <label for="name" class="form-label">Name</label>
							    <input name="name" value="{{ old('name') }}" type="text" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Entre color name">
							    @error('name')
							    	<div class="invalid-feedback">{{ $message }}</div>
							    @enderror
							</div>
							<button class="btn btn-success">Add Color</button>
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


