@extends('layouts.app')

@section('title', 'Categories')

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
                	@if(session('message'))
                	<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
					    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					    {!! session('message') !!}
					</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-centered mb-0">
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
							            		<h6 class="m-0"><span class="badge bg-danger">None</span></h6>
							            	@endif
							            	
							            </td>
							            <td>
							            	<form method="POST" action="{{route('categories.toggleStatus', $category->id)}}">
								            	<input class="status" type="checkbox" id="status-{{$category->id}}" @if($category->status === true) checked @endif data-switch="none"/>
												<label for="status-{{$category->id}}" data-on-label="" data-off-label=""></label>
												@csrf
												@method('PATCH')
											</form>
							            </td>
							            <td>
							            	@if(!empty($category->photo))
							            		<img src="{{ asset($category->photo) }}" alt="category image" class="rounded me-3" height="48">
							            		@else
							            		<h6 class="m-0"><span class="badge bg-danger">None</span></h6>
							            	@endif
							            </td>
							            <td class="table-action">
	                                        <a href="{{ route('categories.edit', $category->id) }}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
	                                        <a data-id="{{$category->id}}" href="javascript:void(0);" class="action-icon delete"> <i class="mdi mdi-delete"></i></a>
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



@section('delete_modal_title', 'Removing Category')
@section('delete_modal_body', 'Are you sure ?')

@include('layouts.deleteModal')


@section('scripts')
<script>
	$(function () {
		const url = '{{route("categories.index")}}';
		$('.delete').click(function(){
			$('#delete-modal').modal('show')
			$('#delete-form').attr('action', `${url}/${$(this).data('id')}`);
		});

		// because there is no submit button in the form (toggle)
		$('.status').click(function(e) {
    		$(this).parent().submit();
		});
	});
</script>
@endsection