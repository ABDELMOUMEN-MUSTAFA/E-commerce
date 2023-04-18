@extends('layouts.auth')

@section('title', 'Lock Screen')

@section('content')
<div class="row justify-content-center">
    <div class="col-xxl-4 col-lg-5">
        <div class="card">
            <!-- Logo -->
            <div class="card-header pt-4 pb-4 text-center bg-primary">
                <a href="index.html">
                    <span><img src="{{ asset('images/logo.png') }}" alt="" height="18"></span>
                </a>
            </div>

            <div class="card-body p-4">
                
                <div class="text-center w-75 m-auto">
                    <img src="{{ asset('images/users/avatar-1.png') }}" height="64" alt="user-image" class="rounded-circle shadow">
                    <h4 class="text-dark-50 text-center mt-3 fw-bold">Hi ! {{session('name')}} </h4>
                    <p class="text-muted mb-4">Enter your password to access the admin.</p>
                </div>

                <form method="POST" action="{{ route('screen.unlock') }}" >
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" class="form-control @error('password') is-invalid @enderror" type="password" required id="password" placeholder="Enter your password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <input type="hidden" name="email" value="{{session('email')}}" />
                    <div class="mb-0 text-center">
                        <button class="btn btn-primary" type="submit">Log In</button>
                    </div>
                    @csrf
                </form>
            </div> <!-- end card-body-->
        </div>
        <!-- end card-->

        <div class="row mt-3">
            <div class="col-12 text-center">
                <p class="text-muted">Not you? return <a href="{{route('login')}}" class="text-muted ms-1"><b>Sign In</b></a></p>
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- end col -->
</div>
<!-- end row -->
@endsection

@section('scripts')
<script>
    // for generating csrf token after logout
    $.get('/refresh-csrf-token', function(token) {
        $('input[name="_token"]').val(token);
    });
</script>
@endsection
