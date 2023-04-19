@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Settings</h4>
            </div>
        </div>
    </div>     
    <div class="row">
        @if(session('message'))
        <div class="col-12">
            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {!! session('message') !!}
            </div>
        </div>
        @endif
        <div class="col-xl-4 col-lg-5">
            <div class="card text-center">
                <div class="card-body">
                    <form method="POST" action="{{route('settings.update')}}" enctype="multipart/form-data">
                    <img src="{{ asset(auth()->user()->avatar) }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                    <h4 class="mb-0 mt-2">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</h4>
                    <p class="text-muted font-14">Admin</p>

                    <input type="file" class="form-control @error('avatar') is-invalid @enderror form-control-sm" name="avatar" />
                    @error('avatar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="text-start mt-3">
                        <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ms-2">{{auth()->user()->phone_number}}</span></p>
                    </div>
                    <div class="text-start mt-3">
                        <p class="text-muted mb-2 font-13"><strong>Email :</strong><span class="ms-2">{{auth()->user()->email}}</span></p>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col-->

        <div class="col-xl-8 col-lg-7">
            <div class="card">
                <div class="card-body">
                        <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Personal Info</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" value="{{old('first_name')}}" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" placeholder="Enter first name">
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" value="{{old('last_name')}}" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" placeholder="Enter last name">
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" value="{{old('phone_number')}}" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" id="phone_number" placeholder='e.g "(xxx) xxxxxxxxx"' data-toggle="input-mask" data-mask-format="(000) 000000000">
                                    @error('phone_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <!-- <span class="font-13 text-muted"></span> -->
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <div class="input-group input-group-merge">
                                        <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Entre current passowrd" name="current_password" autocomplete="current-password">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                        @error('current_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Password Confirmation</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm password">
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                        </div>
                        @csrf
                        @method('PUT')
                    </form>
                </div> 
            </div>
        </div> 
    </div> 
</div> <!-- content --> 
@endsection
