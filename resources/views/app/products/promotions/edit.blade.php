@extends('layouts.app')

@section('title', 'Edit Promotion')

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Promotion</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                    	@if(session('message'))
                            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                {!! session('message') !!}
                            </div>
                        @endif
                        <form method="POST" action="{{route('promotions.update', $promotion->id)}}">
                        	<div class="mb-3">
							    <label for="product" class="form-label">Product name</label>
							    <input type="text" id="product" class="form-control" readonly value="{{$promotion->product->name}}">
							</div>
							<div class="mb-3">
							    <label for="start_date" class="form-label">Start Date</label>
							    <input value="{{$promotion->start_date->format('m/d/Y')}}" type="text" name="start_date" class="form-control date @error('start_date') is-invalid @enderror" id="start_date" data-toggle="date-picker" data-single-date-picker="true">
							    @error('start_date')
							    	<div class="invalid-feedback">{{ $message }}</div>
							    @enderror
							</div>
							<div class="mb-3">
							    <label for="end_date" class="form-label">End Date</label>
							    <input value="{{$promotion->end_date->format('m/d/Y')}}" type="text" name="end_date" class="form-control date @error('end_date') is-invalid @enderror" id="end_date" data-toggle="date-picker" data-single-date-picker="true">
							    @error('end_date')
							    	<div class="invalid-feedback">{{ $message }}</div>
							    @enderror
							</div>
							<div class="mb-3">
								<label for="discount" class="form-label">Discount (%)</label>
								<input class="@error('discount') is-invalid @enderror" type="text" name="discount" id="discount" data-plugin="range-slider" data-min="1" data-max="100" data-from="{{$promotion->discount}}" />
								@error('discount')
							    	<div class="invalid-feedback">{{ $message }}</div>
							    @enderror
							</div>
							
							<button class="btn btn-success">Save changes</button>
						    @csrf
						    @method('PUT')
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