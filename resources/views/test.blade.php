@extends('layouts.app')

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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="row justify-content-center">
                            <div class="col-lg-7 col-md-10 col-sm-11">

                                <div class="horizontal-steps mt-4 mb-4 pb-5" id="tooltip-container">
                                    <div class="horizontal-steps-content">
                                        <div class="step-item">
                                            <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="20/08/2018 07:24 PM">Order Placed</span>
                                        </div>
                                        <div class="step-item">
                                            <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="21/08/2018 11:32 AM">Packed</span>
                                        </div>
                                        <div class="step-item current">
                                            <span>Shipped</span>
                                        </div>
                                        <div class="step-item">
                                            <span>Delivered</span>
                                        </div>
                                    </div>

                                    <div class="process-line" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row --> 
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->        

</div> <!-- container -->

</div> <!-- content -->
@endsection


