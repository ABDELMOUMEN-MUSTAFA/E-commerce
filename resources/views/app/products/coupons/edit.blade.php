@extends('layouts.index')

@section('title', 'Edit Coupon')

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Coupon</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <form method="POST" action="{{route('coupons.update', $coupon->id)}}">
							<div class="mb-3">
							    <label for="expiration_date" class="form-label">Expiration Date</label>
							    <input value="{{$coupon->expiration_date->format('m/d/Y')}}" type="text" name="expiration_date" class="form-control date @error('expiration_date') is-invalid @enderror" id="expiration_date" data-toggle="date-picker" data-single-date-picker="true">
							    @error('expiration_date')
							    	<div class="invalid-feedback">{{ $message }}</div>
							    @enderror
							</div>
							<div class="mb-3">
								<label for="discount" class="form-label">Discount (%)</label>
								<input class="@error('discount') is-invalid @enderror" type="text" name="discount" id="discount" data-plugin="range-slider" data-min="1" data-max="100" data-from="{{$coupon->discount}}" />
								@error('discount')
							    	<div class="invalid-feedback">{{ $message }}</div>
							    @enderror
							</div>
							<div class="mb-3">
							    <label for="usage_limit" class="form-label">Usage Limit</label>
							    <input value="{{$coupon->usage_limit}}" type="numbe" name="usage_limit" class="form-control @error('usage_limit') is-invalid @enderror" id="usage_limit" placeholder="Entre how much client can use this coupon">
							    @error('usage_limit')
							    	<div class="invalid-feedback">{{ $message }}</div>
							    @enderror
							</div>
							<button class="btn btn-success">Save changes</button>
						    @csrf
						    @method('PATCH')
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
<!-- Range Slider -->
<script src="{{ asset('js/vendor/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('js/ui/component.range-slider.js') }}"></script>
@endsection