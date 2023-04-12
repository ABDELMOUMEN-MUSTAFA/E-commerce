@extends('layouts.index')

@section('title', 'Categories')

@section('meta_csrf')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Categories</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <button class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#add-category"><i class="mdi mdi-plus-circle me-2"></i> Add Category</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-centered mb-0">
						    <thead>
						        <tr>
						            <th class="all">Category</th>
						            <th>Description</th>
						            <th>Status</th>
						            <th>Photo</th>
						            <th>Action</th>
						        </tr>
						    </thead>
						    <tbody>
						    	@forelse ($categories as $category)   
								    <tr>
							            <td>
							            	<p class="m-0">{{ $category->name }}</p>
							            </td>
							            <td>
							            	@if(!empty($category->description))
							            		<p class="m-0 text-body text-truncate" style="max-width: 80px">{{ $category->description }}</p>
							            		@else
							            		<p class="m-0 text-body text-truncate" style="max-width: 80px">None</p>
							            	@endif
							            	
							            </td>
							            <td>
							            	<span class="badge bg-success">Active</span>
							            </td>
							            <td>
							            	@if(!empty($category->photo))
							            		<img src="{{ asset('storage/'.$category->photo) }}" alt="category image" class="rounded me-3" height="48">
							            		@else
							            		<p class="m-0 text-body text-truncate" style="max-width: 80px">None</p>
							            	@endif
							            </td>
							            <td class="table-action">
	                                        <a href="javascript:void(0);" data-id="{{ $category->id }}" class="action-icon edit"> <i class="mdi mdi-square-edit-outline"></i></a>
	                                        <a href="javascript:void(0);" data-id="{{ $category->id }}" class="action-icon delete"> <i class="mdi mdi-delete"></i></a>
                                    	</td>
						        	</tr>
								@empty
								    <div class="alert alert-info bg-info text-white border-0" role="alert">
    									No categories found
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

<!-- Add Modal -->
@section('add_model_id', 'add-category')
@section('add_model_title', 'Add Category')
@section('add_model_body')
<form id="add-category-form" method="POST" enctype="multipart/form-data">
	<div class="mb-3">
	    <label for="name" class="form-label">Name</label>
	    <input name="name" type="text" id="name" class="form-control" placeholder="Entre categoty name">
        <div class="invalid-feedback"></div>
	</div>
	<div class="mb-3">
	    <label for="description" class="form-label">Description</label>
	    <textarea placeholder="Entre category description" class="form-control" name="description" id="description" rows="5"></textarea>
	    <div class="invalid-feedback"></div>
	</div>
	<div class="mb-3">
	    <label for="photo" class="form-label">Photo</label>
	    <input type="file" name="photo" id="photo" class="form-control">
	    <div class="invalid-feedback"></div>
	</div>
	<div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
    </div>
</form>
@endsection

@include('layouts.addModal')
<!-- End Add Modal -->

<!-- Delete Modal -->
@section('delete_model_id', 'delete-category')
@section('delete_model_title', 'Are you sue ?')
@section('delete_model_body')
You are just about to delete a category, press continue to precced
@endsection

@include('layouts.deleteModal')
<!-- End Delete Modal -->


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
	$(document).ready(function () {
		const showingAndRemovingErrors = (errors, name) => {
			const field = $(`[name="${name}"]`);
        	if(errors[name]){
        		field.addClass('is-invalid');
        		field.next().text(errors[name]);
        	}else{
        		field.removeClass('is-invalid');
        		field.next().text("");
        	}	
		}

		const clearErrorMessagesAndValues = () => {
			const $fields = $("input, textarea");
			$fields.removeClass('is-invalid');
			$fields.next().text("");
			$field.val("");
		}

		// Add Category
		$('#add-category-form').submit(function (event) {
			event.preventDefault();
			const form = new FormData(this);
			$.ajax({
				headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : `{{ route('categories.store') }}`,
                type : 'POST',
                data : form,
                dataType : 'json',
                processData: false,
                cache: false,
      	 		contentType: false,
                success : function (response){
                	console.log(response.message);
                	$('#add-category').modal('toggle');
                	clearErrorMessagesAndValues();
                },
                error : function(data) {
                	const { errors } = JSON.parse(data.responseText);
                	showingAndRemovingErrors(errors, 'name');
                	showingAndRemovingErrors(errors, 'description');
                	showingAndRemovingErrors(errors, 'photo');
				}
            });
		});
		// End Add Category

		// Delete Category
		$('.delete').click(function () {
			const id = $(this).data('id');
			$('#delete-category').modal('show');

			// remove Old EventListener
			$('#confirm').off();
			$('#confirm').click(function (){
				$.ajax({
					headers : {
                    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                	},
                	url : "{{ route('categories.index') }}/" + id,
                	type: "DELETE",
                	dataType : 'json',
                	success : function (response){
	                	console.log(response.message);
	                },
	                error : function(data) {
	                	console.log(data.responseText);
					}
				});
			});
		});

		// CSRF TOKEN REFRESHER
		let csrfToken = $('[name="csrf_token"]').attr('content');
    
	    setInterval(refreshToken, 3600000); // 1 hour 
	    
	    function refreshToken(){
	        $.get('refresh-csrf').done(function(data){
	            csrfToken = data; // the new token
	        });
	    }

	    setInterval(refreshToken, 3600000); // 1 hour 
	});
</script>
@endsection