@extends('layouts.auth')

@section('title', 'Reset Password')

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
                
                <div class="text-center w-75 m-auto">
                    <h4 class="text-dark-50 text-center mt-0 fw-bold">Reset Password</h4>
                    <p class="text-muted mb-4">Enter your email address and we'll send you an email with instructions to reset your password.</p>
                </div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    <div class="mb-3">
                        <label for="emailaddress" class="form-label">Email address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-0 text-center">
                        <button class="btn btn-primary" type="submit">Send Password Reset Link</button>
                    </div>
                    @csrf
                </form>
            </div> <!-- end card-body-->
        </div>
        <!-- end card -->

        <div class="row mt-3">
            <div class="col-12 text-center">
                <p class="text-muted">Back to <a href="{{route('login')}}" class="text-muted ms-1"><b>Log In</b></a></p>
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- end col -->
</div>
<!-- end row -->
@endsection

<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

 -->