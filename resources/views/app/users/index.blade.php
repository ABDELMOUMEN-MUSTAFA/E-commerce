@extends('layouts.app')

@section('title', 'Users')


@section('content')
 <!-- Start Content-->
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Users</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(session('message'))
                        <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {!! session('message') !!}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-centered dt-responsive nowrap w-100" id="Users-datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>User</th>
                                    <th>Role</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Country</th>
                                    <th>Create Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Email Confirmation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td class="table-user">
                                            <img src="{{asset($user->avatar)}}" alt="table-user" class="me-2 rounded-circle">
                                            <a href="{{route('users.show', $user->id)}}" class="text-body fw-semibold">{{$user->first_name}} {{$user->last_name}}</a>
                                        </td>
                                        <td>
                                            @if($user->is_admin === true)
                                                <span class="badge badge-primary-lighten">Admin</span>
                                            @else
                                                <span class="badge badge-secondary-lighten">customer</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{$user->phone_number}}
                                        </td>
                                        <td>
                                            {{$user->email}}
                                        </td>
                                        <td>
                                            {{$user->country->name}}
                                        </td>
                                        <td>
                                            {{$user->created_at->format('d/m/Y')}}
                                        </td>
                                        <td>
                                            <form method="POST" action="{{route('users.toggleActive', $user->id)}}">
                                                <input class="status" type="checkbox" id="status-{{$user->id}}" @if($user->is_active === true) checked @endif data-switch="none"/>
                                                <label for="status-{{$user->id}}" data-on-label="" data-off-label=""></label>
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{route('users.edit', $user->id)}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" onclick="showModalToConfirmDelete({{$user->id}});" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                        <td>
                                            @if($user->email_verified_at === null)
                                                <span class="badge bg-warning-lighten text-warning">not verified</span>
                                            @else
                                                <span class="badge bg-success-lighten text-success">verified</span>
                                            @endif
                                        </td>   
                                    </tr>
                                @empty
                                    <div class="alert alert-info bg-info text-white border-0" role="alert">
                                        No Users found
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
    
</div> <!-- container -->

</div> <!-- content -->
@endsection

@section('delete_modal_title', 'Removing User')
@section('delete_modal_body', 'Are you sure ?')

@include('layouts.deleteModal')


@section('scripts')
<script>
    const url = '{{route("users.index")}}';
    // Event Handler Deletion
    function showModalToConfirmDelete(id) {
        $('#delete-modal').modal('show');
        $('#delete-form').attr('action', `${url}/${id}`);
    }

    // because there is no submit button in the form (toggle)
    $(function () {
        $('#Users-datatable').DataTable();
        
        // Toggle Product Status
        $('.status').click(function(e) {
            $(this).parent().submit();
        });
    });
</script>
@endsection