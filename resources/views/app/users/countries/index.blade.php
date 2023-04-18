@extends('layouts.app')

@section('title', 'Countries')

@section('content')
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Countries</h4>
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
                    <div>
                    	<a href="{{route('countries.create')}}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add Country</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-centered mb-0">
						    <thead>
						        <tr>
						            <th>Country</th>
						            <th class="text-end">Action</th>
						        </tr>
						    </thead>
						    <tbody>
						    	@forelse ($countries as $country)   
								    <tr>
							            <td>
							            	<span data-id="{{$country->id}}">{{ $country->name }}</span>
							            </td>
							            <td class="table-action text-end">
	                                        <a data-id="{{$country->id}}" href="javascript:void(0);" class="action-icon rename"> <i class="mdi mdi-square-edit-outline"></i></a>
	                                        <a data-id="{{$country->id}}" href="javascript:void(0);" class="action-icon delete"> <i class="mdi mdi-delete"></i></a>
                                    	</td>
						        	</tr>
								@empty
									<tr>
										<td colspan="2">
											<div class="alert alert-info bg-info text-white border-0" role="alert">
    										No countries found
											</div>
										</td>
									</tr>						    		
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


@section('edit_model_id', 'rename-modal')
@section('edit_model_title', 'Rename country')
@section('edit_model_body')
<form id="rename-country" method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Rename</label>
        <input name="name" type="text" id="name" class="form-control" placeholder="Entre new country name">
        <div class="invalid-feedback name"></div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary">Save changes</button>
    </div>
    @csrf
</form>
@endsection

@include('layouts.editModal')


@section('delete_modal_title', 'Removing Size')
@section('delete_modal_body', 'Are you sure ?')

@include('layouts.deleteModal')


@section('scripts')
<script>
	$(function () {
		const url = '{{ route("countries.index") }}';
		$('.delete').click(function(){
			$('#delete-modal').modal('show')
			$('#delete-form').attr('action', `${url}/${$(this).data('id')}`);
		});

		let sizeID;
	    $('.rename').click(function () {
	        $('#rename-modal').modal('show');
	        sizeID = $(this).data('id');
	    });

	    $('#rename-country').submit(function(event){
	        event.preventDefault();
	        // country name field
	        const $name = $('#name');
	        // invalid-feedback for country name field
	        const $feedbackName = $('.invalid-feedback.name');

	        const formData = $(this).serializeArray();
	        
	        $.ajax({
	            url : `${url}/${sizeID}`,
	            type : 'PATCH',
	            data : formData,
	            success: function(response){
	                $('#rename-modal').modal('hide');
	                $.NotificationApp.send("Rename country",response.message,"top-right","success","success")
	                $(`span[data-id=${sizeID}]`).text(formData[0].value);
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