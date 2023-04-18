@extends('layouts.auth')


@section('title', 'Confirm Email')

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
                    <img src="{{asset('images/mail_sent.svg') }}" alt="mail sent image" height="64" />
                    <h4 class="text-dark-50 text-center mt-4 fw-bold">Please check your email</h4>
                    <p class="text-muted mb-4">
                        A email has been send to <b>{{auth()->user()->email}}</b>.
                        Please check for an email from company and click on the included link to
                        verify your account. 
                    </p>
                </div>
                @if(session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('verification.resend') }}">
                    <div class="mb-0 text-center">
                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-refresh me-1"></i> {{ __('Resend Email') }}</button>
                    </div>
                    @csrf
                </form>

            </div> <!-- end card-body-->
        </div>
        <!-- end card-->
        
    </div> <!-- end col -->
</div>
<!-- end row -->
@endsection








<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

 -->