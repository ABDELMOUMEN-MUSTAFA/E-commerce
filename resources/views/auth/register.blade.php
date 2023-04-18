@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="row justify-content-center">
    <div class="col-xxl-4 col-lg-5">
        <div class="card">
            <!-- Logo-->
            <div class="card-header pt-4 pb-4 text-center bg-primary">
                <a href="{{route('index')}}">
                    <span><img src="{{ asset('images/logo.png') }}" alt="" height="18"></span>
                </a>
            </div>

            <div class="card-body p-4">
                
                <div class="text-center w-75 m-auto">
                    <h4 class="text-dark-50 text-center mt-0 fw-bold">Free Sign Up</h4>
                    <p class="text-muted mb-4">Don't have an account? Create your account, it takes less than a minute </p>
                </div>

                <form method="POST" action="{{ route('register') }}">

                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" placeholder="Entre first name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input id="last_name" placeholder="Entre last name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required>
                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input placeholder='e.g "(xxx) xxxxxxxxx"' name="phone_number" id="phone_number" type="text" value="{{ old('phone_number') }}" class="form-control  @error('phone_number') is-invalid @enderror" data-toggle="input-mask" data-mask-format="(000) 000000000">
                        @error('phone_number')
                             <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input placeholder="Entre email address" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group input-group-merge">
                            <input placeholder="Entre password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
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
                            <input name="agreement" type="checkbox" class="form-check-input @error('agreement') is-invalid @enderror" id="checkbox-signup">
                            <label class="form-check-label" for="checkbox-signup">I accept <a href="#">Terms and Conditions</a></label>
                            @error('agreement')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 text-center">
                        <button class="btn btn-primary" type="submit"> Sign Up </button>
                    </div>
                    @csrf
                </form>
            </div> <!-- end card-body -->
        </div>
        <!-- end card -->

        <div class="row mt-3">
            <div class="col-12 text-center">
                <p class="text-muted">Already have account? <a href="{{route('login')}}" class="text-muted ms-1"><b>Log In</b></a></p>
            </div> <!-- end col-->
        </div>
        <!-- end row -->

    </div> <!-- end col -->
</div>
<!-- end row -->
@endsection