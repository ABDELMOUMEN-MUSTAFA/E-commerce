@extends('layouts.auth')

@section('title', 'Log In')

@section('content')
<div class="row justify-content-center">
    <div class="col-xxl-4 col-lg-5">
        <div class="card">

            <!-- Logo -->
            <div class="card-header pt-4 pb-4 text-center bg-primary">
                <a href="{{route('index')}}">
                    <span><img src="{{ asset('images/logo.png') }}" alt="website logo" height="18"></span>
                </a>
            </div>

            <div class="card-body p-4">
                
                <div class="text-center w-75 m-auto">
                    <h4 class="text-dark-50 text-center pb-0 fw-bold">Sign In</h4>
                    <p class="text-muted mb-4">Enter your email address and password to access admin panel.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" >

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input id="email" placeholder="Entre your email address" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        @if (Route::has('password.request'))
                            <a class="text-muted float-end" href="{{ route('password.request') }}">
                                <small>{{ __('Forgot Your Password?') }}</small>
                            </a>
                        @endif
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group input-group-merge">
                            <input placeholder="Entre your password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            <div class="input-group-text" data-password="false">
                                <span class="password-eye"></span>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="checkbox-signin">Remember me</label>
                        </div>
                    </div>

                    <div class="mb-0 text-center d-grid">
                        <button class="btn btn-primary" type="submit"> Log In </button>
                    </div>
                    @csrf
                </form>
            </div> <!-- end card-body -->
        </div>
        <!-- end card -->

        <div class="row mt-3">
            <div class="col-12 text-center">
                <p class="text-muted">Don't have an account? <a href="{{route('register')}}" class="text-muted ms-1"><b>Sign Up</b></a></p>
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- end col -->
</div>
<!-- end row -->
@endsection