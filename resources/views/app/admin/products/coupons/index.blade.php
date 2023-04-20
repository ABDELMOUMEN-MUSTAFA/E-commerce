@extends('layouts.admin.app')

@section('title', 'Coupons')

@section('content')
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Coupons</h4>
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
                        <table id="coupons" class="table table-centered dt-responsive nowrap w-100">
						    <thead class="table-light">
						        <tr>
						            <th class="all">Coupon</th>
						            <th>Discount</th>
						            <th>Stay Valid For</th>
						            <th>Status</th>
						            <th>Date Created</th>
						            <th>Expiration Date</th>
						            <th>Product</th>
						            <th>Action</th>
						        </tr>
						    </thead>
						    <tbody>
						    	@forelse ($coupons as $coupon)   
								    <tr>
							            <td>
							            	<span>{{ $coupon->code }}</span>
							            </td>
							            <td>
							            	<span>{{ $coupon->discount }}%</span>
							            </td>
							            <td>
							            	<span>{{$coupon->usage_limit}} Customers</span>
							            </td>
							            <td>
							            	<form action="{{route('coupons.toggleStatus', $coupon->id)}}" method="POST">
							            	<input class="status" type="checkbox" id="is_active-{{$coupon->id}}" @if($coupon->is_active === true) checked @endif data-switch="none"/>
											<label for="is_active-{{$coupon->id}}" data-on-label="" data-off-label=""></label>
											@csrf
											@method('PATCH')
											</form>
							            </td>
							            <td>
							            	<span>{{$coupon->created_at->format('d/m/Y')}}</span>
							            </td>
							            <td>
							            	<span>{{$coupon->expiration_date->format('d/m/Y')}}</span>
							            </td>
							            <td>
							            	<span class="d-block text-truncate" style="max-width: 75px"><a href="{{route('products.show', $coupon->product->id)}}">{{$coupon->product->name}}</a></span>
							            </td>
							            <td class="table-action">
	                                        <a href="{{ route('coupons.edit', $coupon->id) }}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
	                                        <a onclick="showModalToConfirmDelete({{$coupon->id}});" href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                    	</td>
						        	</tr>
								@empty
								    <div class="alert alert-info bg-info text-white border-0" role="alert">
    									No coupons found
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


@section('delete_modal_title', 'Removing Coupon')
@section('delete_modal_body', 'Are you sure ?')

@include('layouts.admin.deleteModal')


@section('scripts')
<script>

	const url = '{{route("coupons.index")}}';
    // Event Handler Deletion
    function showModalToConfirmDelete(id) {
        $('#delete-modal').modal('show');
        $('#delete-form').attr('action', `${url}/${id}`);
    }

	$(function () {
		$('#coupons').DataTable();

		// because there is no submit button in the form (toggle)
		$('.status').click(function(e) {
    		$(this).parent().submit();
		});
	});
</script>
@endsection