@extends('layouts.admin.app')

@section('title', 'Sliders')

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Sliders</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
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
						            <th class="all">Name</th>
						            <th>Title</th>
						            <th>Description</th>
						            <th>Photo</th>
						            <th>Action</th>
						        </tr>
						    </thead>
						    <tbody>
						    	@forelse ($sliders as $slider)   
								    <tr>
							            <td>
							            	<p class="m-0">{{ $slider->name }}</p>
							            </td>
							            <th>
							            	<p class="m-0">{{$slider->title}}</p>
							            </th>
							            <td>
							            	<p class="m-0 text-body text-truncate" style="max-width: 80px">{{ $slider->description }}</p>
							            </td>
							            <td>
							            	<img src="{{ asset($slider->photo) }}" alt="slider image" class="rounded me-3" height="48">	
							            </td>
							            <td class="table-action">
	                                        <a href="{{ route('sliders.edit', $slider->id) }}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
	                                        <a data-id="{{$slider->id}}" href="javascript:void(0);" class="action-icon delete"> <i class="mdi mdi-delete"></i></a>
                                    	</td>
						        	</tr>
								@empty
								    <div class="alert alert-info bg-info text-white border-0" role="alert">
    									No sliders found
									</div>
								@endforelse
						    </tbody>
						</table>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->      

</div> <!-- container -->

</div> <!-- content -->
@endsection

@section('delete_modal_title', 'Removing Slider')
@section('delete_modal_body', 'Are you sure ?')

@include('layouts.admin.deleteModal')


@section('scripts')
<script>
	$(function () {
		const url = '{{route("sliders.index")}}';
		$('.delete').click(function(){
			$('#delete-modal').modal('show')
			$('#delete-form').attr('action', `${url}/${$(this).data('id')}`);
		});
	});
</script>
@endsection