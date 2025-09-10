@extends('admin.admin_dashboard')
@section('title','Edit Role')
@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Role </h6>
                        <form id="myForm" method="POST" action="{{ route('update.roles') }}" class="forms-sample">
                            @csrf
                            <input type="hidden" name="id" value="{{ $roles->id }}">
                            <div class="form-group mb-3">
                                <label class="form-label">Roles Name </label>
                                <input type="text" name="name" class="form-control" value="{{ $roles->name }}">
                            </div>
                            <button type="submit" id="submitBtn" class="btn btn-primary me-2">Save Changes </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- middle wrapper end -->
    </div>
</div>
<!-- JQuery -->
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

<!-- Form Validation-->
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: 'Please enter the name.',
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                // Disable the submit button to prevent multiple submissions
                $("#submitBtn").prop("disabled", true);

                // Proceed with form submission
                form.submit();
            }
        });
    });
</script>
@endsection
