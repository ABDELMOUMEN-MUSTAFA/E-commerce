@extends('layouts.auth')


@section('title', 'Banned Account')

@section('content')
<div class="row justify-content-center">
    <div class="col-xxl-4 col-lg-5">
        <div class="card">
            <!-- Logo -->
            <div class="card-header pt-4 pb-4 text-center bg-primary">
                <a href="{{route('index')}}">
                    <span><img src="{{ asset('images/logo.png') }}" alt="" height="18"></span>
                </a>
            </div>

            <div class="card-body p-4">
                
                <div class="text-center m-auto">
                    <img src="{{asset('images/banned-account.png') }}" alt="mail sent image" height="64" />
                    <h4 class="text-danger text-center mt-4 fw-bold">Your account is currently suspended</h4>
                    <p class="text-muted mb-4">
                        If you have further questions, contact us <strong>shopfromme@gmail.com</strong> 
                    </p>
                    <a href="#" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="mdi mdi-logout me-1"></i>Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                </div>

            </div> <!-- end card-body-->
        </div>
        <!-- end card-->
        
    </div> <!-- end col -->
</div>
<!-- end row -->
@endsection



