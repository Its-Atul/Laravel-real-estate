@extends('admin.admin_dashboard')
@section('title','Add Permission')
@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Permission </h6>
                        <form id="myForm" method="POST" action="{{ route('store.permission') }}" class="forms-sample">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="form-label">Permission Name </label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Group Name </label>
                                <select name="group_name" class="form-control @error('group_name') is-invalid @enderror">
                                    <option selected="" disabled="">Select Group</option>
                                    <option value="property_type">Property Type</option>
                                    <option value="location">Location</option>
                                    <option value="amenities">Amenities</option>
                                    <option value="property">Property</option>
                                    <option value="history">Package History </option>
                                    <option value="message">Property Message </option>
                                    <option value="schedule">Schedule </option>
                                    <option value="contact">Contact </option>
                                    <option value="testimonials">Testimonials</option>
                                    <option value="user">User</option>
                                    <option value="agent">Agent</option>
                                    <option value="admin_user">Admin</option>
                                    <option value="blog">Blog</option>
                                    <option value="setting">Setting</option>
                                    <option value="role_permission">Role & Permission </option>
                                </select>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
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
                group_name: {
                    required: true,

                },
            },
            messages: {
                name: {
                    required: 'Please enter the name.',
                },
                group_name: {
                    required: 'Please select group name.',
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
