@extends('layouts.app')

@section('title', 'Subcategories')

@section('content')
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Subcategories</h4>
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
						            <th class="all">Subcategory</th>
						            <th>Category</th>
						            <th>Action</th>
						        </tr>
						    </thead>
						    <tbody>
						    	@forelse ($subcategories as $subcategory)   
								    <tr>
							            <td>
							            	<span>{{ $subcategory->name }}</span>
							            </td>
							           
							            <td>
							            	<span>{{ $subcategory->category->name }}</span>
							            </td>
							            <td class="table-action">
	                                        <a href="{{ route('subcategories.edit', $subcategory->id) }}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
	                                        <a data-id="{{$subcategory->id}}" href="javascript:void(0);" class="action-icon delete"> <i class="mdi mdi-delete"></i></a>
                                    	</td>
						        	</tr>
								@empty
								    <div class="alert alert-info bg-info text-white border-0" role="alert">
    									No subcategories found
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



@section('delete_modal_title', 'Removing Subcategory')
@section('delete_modal_body', 'Are you sure ?')

@include('layouts.deleteModal')


@section('scripts')
<script>
	$(function () {
		const url = '{{ route("subcategories.index") }}';
		$('.delete').click(function(){
			$('#delete-modal').modal('show')
			$('#delete-form').attr('action', `${url}/${$(this).data('id')}`);
		});
	});
</script>
@endsection