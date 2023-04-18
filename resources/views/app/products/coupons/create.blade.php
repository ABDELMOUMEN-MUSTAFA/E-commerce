@extends('layouts.app')

@section('title', 'Generate Coupons')

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Generate Coupon</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <form method="POST" action="{{route('coupons.store')}}">
							<div class="mb-3">
							    <label for="name" class="form-label">Product Name</label>
							    <input name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" id="name" type="text" placeholder="Search for the product">
							    @error('product_id')
					    			<small class="text-danger d-block mt-1">{{ $message }}</small>
					    		@enderror
							</div>
							<input type="hidden" name="product_id" id="product" value="{{old('product_id')}}" />
							<div class="mb-3">
							    <label for="code" class="form-label">Coupon Code (if you don't provide one, it will generated automatically)</label>
							    <input value="{{old('code')}}" type="text" name="code" class="form-control @error('code') is-invalid @enderror" id="code" placeholder="Entre coupon code you like">
							    @error('code')
							    	<div class="invalid-feedback">{{ $message }}</div>
							    @enderror
							</div>
							<div class="mb-3">
							    <label for="expiration_date" class="form-label">Expiration Date</label>
							    <input value="{{old('expiration_date')}}" type="text" name="expiration_date" class="form-control date @error('expiration_date') is-invalid @enderror" id="expiration_date" data-toggle="date-picker" data-single-date-picker="true">
							    @error('expiration_date')
							    	<div class="invalid-feedback">{{ $message }}</div>
							    @enderror
							</div>
							<div class="mb-3">
								<label for="discount" class="form-label">Discount (%)</label>
								<input class="@error('discount') is-invalid @enderror" type="text" name="discount" id="discount" data-plugin="range-slider" data-min="1" data-max="100" data-from="{{old('discount')}}" />
								@error('discount')
							    	<div class="invalid-feedback">{{ $message }}</div>
							    @enderror
							</div>
							<div class="mb-3">
							    <label for="usage_limit" class="form-label">Usage Limit</label>
							    <input value="{{old('usage_limit')}}" type="numbe" name="usage_limit" class="form-control @error('usage_limit') is-invalid @enderror" id="usage_limit" placeholder="Entre how much client can use this coupon">
							    @error('usage_limit')
							    	<div class="invalid-feedback">{{ $message }}</div>
							    @enderror
							</div>
							<button class="btn btn-success">Add Coupon</button>
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
<!-- Typehead -->
<script src="{{ asset('js/vendor/typeahead.bundle.min.js') }}"></script>

<script>
const url = '{{route("products.search")}}';

let searchedProduct = [];
const products = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	remote: {
		url: `${url}?productName=%QUERY`,
		wildcard: '%QUERY',
		filter: function(data) {
			// To know the ID of selected product after event `typeahead:selected` accurs
			searchedProduct = data;

			return data.map(function (item) {   
			    return item.name;
			});
		}
	}
});

$('#name').typeahead(null, {
  source: products
});

$('#name').on('typeahead:selected', function(evt, item) {
    for(let product of searchedProduct){
    	if(product.name === item){
    		// remove old hidden input if exists (product_id)
    		$('#product').remove();
    		// product id
    		const $hiddeninput = $(`<input type="hidden" name="product_id" id="product" value="${product.id}" />`);
    		$(this).after($hiddeninput);
    		console.log(product.id)
    		break;
    	}
    }
});

</script>

<!-- Range Slider -->
<script src="{{ asset('js/vendor/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('js/ui/component.range-slider.js') }}"></script>
@endsection