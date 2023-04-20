@extends('layouts.admin.app')

@section('title', 'Upload Photos')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection

@section('content')
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Add Photos To Product</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                    	<!-- File Upload -->
						<form action="{{route('photos.store')}}" method="post" class="dropzone" id="upload-photos">
							<div class="mb-3">
							    <label for="product" class="form-label">Product name</label>
							    <input type="text" id="product" class="form-control" readonly value="{{$product->name}}">
							</div>
							<input type="hidden" name="product_id" value="{{$product->id}}">
						    <div class="dz-message needsclick">
						        <i class="h1 text-muted dripicons-cloud-upload"></i>
						        <h3>Drop photos here or click to upload.</h3>
						    </div>
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


@section('scripts')
<!-- plugin js -->
<script src="{{ asset('js/vendor/dropzone.min.js') }}"></script>
<script>
	Dropzone.options.uploadPhotos = { // camelized version of the `id`
		paramName: "photos", // The name that will be used to transfer the file
		maxFilesize: 10,
		acceptedFiles: ".jpg,.jpeg,.png,.bmp,.gif,.svg,.webp",
		// forceFallback : true,
		maxFilesize: 10, // MB
		success: function(file, response) {
			$.NotificationApp.send("Upload Photos",response.message,"top-right","success","success")
		},
		complete: function (file, response) {
			if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
		    	window.setTimeout(function () {
		    		window.location.href = '{{route("products.show", $product->id)}}';
		    	}, 4000);
		    }
		},
		error: function (file, response){
			$(file.previewElement).addClass("dz-error").find('.dz-error-message').text(response.message);
		}
	};
</script>
@endsection