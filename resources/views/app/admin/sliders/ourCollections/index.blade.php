@extends('layouts.admin.app')

@section('title', 'Our Collection')

@section('content')
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Our Collection</h4>
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
                    <a class="btn btn-primary" href="{{route('createCollection')}}">Add Collection</a>
                    <div class="table-responsive">
                        <table class="table table-centered mb-0">
						    <thead>
						        <tr>
						            <th>Title</th>
						            <th>Description</th>
						            <th>Photo</th>
						            <th>Type</th>
						            <th>Action</th>
						        </tr>
						    </thead>
						    <tbody>
						    	@forelse ($ourCollections as $collection)   
								    <tr>
							            <th>
							            	<p class="m-0">{{$collection->title}}</p>
							            </th>
							            <td>
							            	<p class="m-0 text-body text-truncate" style="max-width: 80px">{{ $collection->description }}</p>
							            </td>
							            <td>
							            	<img src="{{ asset($collection->photo) }}" alt="collection image" class="rounded me-3" height="48">	
							            </td>
							            <td>
							            	<span class="badge bg-info">{{$collection->type}}</span>
							            </td>
							            <td class="table-action">
	                                        <a href="{{ route('editCollection', $collection->id) }}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
	                                        <a data-id="{{$collection->id}}" href="javascript:void(0);" class="action-icon delete"> <i class="mdi mdi-delete"></i></a>
                                    	</td>
						        	</tr>
								@empty
								    <div class="alert alert-info bg-info text-white border-0 mt-3" role="alert">
    									No collections found
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

@section('delete_modal_title', 'Removing Collectin')
@section('delete_modal_body', 'Are you sure ?')

@include('layouts.admin.deleteModal')


@section('scripts')
<script>
	$(function () {
		const url = '{{route("deleteCollection", '')}}';
		$('.delete').click(function(){
			$('#delete-modal').modal('show')
			$('#delete-form').attr('action', `${url}/${$(this).data('id')}`);
		});
	});
</script>
@endsection
