@section('deleteModal')
<!-- Delete Modal -->
<div id="@yield('delete_model_id')" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-filled bg-danger">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-wrong h1"></i>
                    <h4 class="mt-2">@yield('delete_model_title')</h4>
                    <p class="mt-3">@yield('delete_model_body')</p>
                    <button id="confirm" type="button" class="btn btn-light my-2" data-bs-dismiss="modal">Continue</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- / Delete Modal -->
@endsection