@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
 <div class="row">
    <div class="col-xl-5 col-lg-6">
        <div class="row">
            <div class="col-lg-6">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-account-multiple widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Customers</h5>
                        <h3 class="mt-3 mb-3">{{$currentMonthCustomers}}</h3>
                        <p class="mb-0 text-muted">
                            @if($percentageChange["customers"] >= 0)
                                <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> {{number_format($percentageChange["customers"], 2)}}%</span>
                            @else
                                <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> {{number_format($percentageChange["customers"], 2)}}%</span>
                            @endif
                            <span class="text-nowrap">Since last month</span>  
                        </p>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

            <div class="col-lg-6">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-cart-plus widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Orders</h5>
                        <h3 class="mt-3 mb-3">{{$currentMonthOrders}}</h3>
                        <p class="mb-0 text-muted">
                            @if($percentageChange["orders"] >= 0)
                                <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> {{number_format($percentageChange["orders"], 2)}}%</span>
                            @else
                                <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> {{number_format($percentageChange["orders"], 2)}}%</span>
                            @endif
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div> <!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-currency-usd widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Revenue</h5>
                        <h3 class="mt-3 mb-3">${{number_format($lastTwoMonthsRevenue[1]->revenue, 2)}}</h3>
                        <p class="mb-0 text-muted">
                            @if($percentageChange["revenue"] >= 0)
                                <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> {{number_format($percentageChange["revenue"], 2)}}%</span>
                            @else
                                <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> {{number_format($percentageChange["revenue"], 2)}}%</span>
                            @endif
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

            <div class="col-lg-6">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-pulse widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Number of products">Products</h5>
                        <h3 class="mt-3 mb-3">{{$currentMonthProducts}}</h3>
                        <p class="mb-0 text-muted">
                            @if($percentageChange["products"] >= 0)
                                <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> {{number_format($percentageChange["products"], 2)}}%</span>
                            @else
                                <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> {{number_format($percentageChange["products"], 2)}}%</span>
                            @endif
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div> <!-- end row -->

    </div> <!-- end col -->

    <div class="col-xl-7 col-lg-6">
        <div class="card card-h-100">
            <div class="card-body">
                <h4 class="header-title mb-0">Monthly Sales and Revenue</h4>

                <div>
                    <div id="monthly-statistics"></div>
                </div>
                    
            </div> <!-- end card-body-->
        </div> <!-- end card-->

    </div> <!-- end col -->
</div>
<!-- end row -->

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mt-2 mb-3">Top Selling Products</h4>
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap table-hover mb-0">
                        <tbody>
                            @foreach($topSellingProducts as $product)
                            <tr>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">{{$product->name}}</h5>
                                    <span class="text-muted font-13">Product Name</span>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">{{$product->quantity}}</h5>
                                    <span class="text-muted font-13">Quantity</span>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1 fw-normal">${{number_format($product->amount, 2)}}</h5>
                                    <span class="text-muted font-13">Amount</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Top selling coutries</h4>
                @foreach($topSellingCountries as $country)
                <h5 class="mb-1 mt-3 fw-normal">{{$country->name}}</h5>
                <div class="progress-w-percent @if($loop->last) mb-0 @endif">
                    <span class="progress-value fw-bold">{{$country->numberCustomers}}</span>
                    <div class="progress progress-sm">
                        <div class="progress-bar" role="progressbar" style="width: {{$country->numberCustomers}}%;" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                @endforeach
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>
<!-- end row -->

</div>
<!-- container -->
@endsection


@section('scripts')
<!-- third party js -->
<script src="{{ asset('js/vendor/apexcharts.min.js') }}"></script>
<!-- third party js ends -->

<!-- data-colors="#727cf5,#e3eaef" -->
<script>
    const months = [];
    const sales = [];
    const revenue = [];

    const options = {
        series: [{
            name: 'Revenue',
            type: 'column',
            data: revenue,
        }, {
            name: 'Sales',
            type: 'line',
            data: sales
        }],
        chart: {
            type: 'line',
            toolbar: {
                show: false,
            },
        },
        stroke: {
            width: [0, 4]
        },
        dataLabels: {
            enabled: true,
            enabledOnSeries: [1]
        },
        labels: months,
        yaxis: [
        {
            title: {
                text: 'Revenue',
            },
            labels: {
                formatter: function(val, index) {
                    return '$' + val.toFixed(2);
                }
            }
        }, 
        {
            opposite: true,
            title: {
                text: 'Sales'
            },
            labels: {
                formatter: function(val, index) {
                    return val.toFixed(0);
                }
            }
        }],
    };

    const chart = new ApexCharts(document.querySelector("#monthly-statistics"), options);
    
    $.ajax({
        url : "{{route('getMonthlyStatistics')}}",
        success: function(response){
            response.forEach(function(m){
                months.push(m.month);
                sales.push(m.sales);
                revenue.push(Number(m.revenue));
                console.log(Number(m.revenue));
            });
            chart.render();
            console.log(revenue);
        }
    });
</script>
@endsection