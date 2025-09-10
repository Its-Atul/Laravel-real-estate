@extends('admin.admin_dashboard')
@section('title','Change Password')
@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <!-- left wrapper start -->
        <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
            <div class="card rounded">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div>
                            <img class="wd-50 ht-50 rounded-circle"
                                src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg') }}"
                                alt="profile">
                            <span class="h4 ms-3 ">{{ $profileData->name }}</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">User Name:</label>
                        <p class="text-muted">{{ $profileData->username }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                        <p class="text-muted">{{ $profileData->email }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
                        <p class="text-muted">{{ $profileData->phone }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
                        <p class="text-muted">{{ $profileData->address }}</p>
                    </div>
                    <div class="mt-3 d-flex social-links">
                        <a href="{{ $profileData->facebook ?? 'javascript:void(0)' }}" class="btn btn-icon border btn-xs me-2">
                            <i data-feather="facebook"></i>
                        </a>
                        <a href="{{ $profileData->youtube ?? 'javascript:void(0)' }}" class="btn btn-icon border btn-xs me-2">
                            <i data-feather="youtube"></i>
                        </a>
                        <a href="{{ $profileData->twitter ?? 'javascript:void(0)' }}" class="btn btn-icon border btn-xs me-2">
                            <i data-feather="twitter"></i>
                        </a>
                        <a href="{{ $profileData->instagram ?? 'javascript:void(0)' }}" class="btn btn-icon border btn-xs me-2">
                            <i data-feather="instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Admin Change Password </h6>
                        <form method="POST" action="{{ route('admin.update.password') }}" class="forms-sample" id="myForm">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="old_password" class="form-label">Old Password </label>
                                <input type="password" name="old_password"
                                    class="form-control @error('old_password') is-invalid @enderror " id="old_password"
                                    autocomplete="off">
                                @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="new_password" class="form-label">New Password </label>
                                <input type="password" name="new_password"
                                    class="form-control @error('new_password') is-invalid @enderror " id="new_password"
                                    autocomplete="off">
                                @error('new_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="new_password_confirmation" class="form-label">Confirm New Password </label>
                                <input type="password" name="new_password_confirmation" class="form-control"
                                    id="new_password_confirmation" autocomplete="off">
                            </div>
                            <button type="submit" id="submitBtn" class="btn btn-primary me-2">Save Changes </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--  JQuery   --}}
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
<!-- Form Validation-->
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                old_password: {
                    required: true,
                },
                new_password: {
                    required: true,
                    minlength: 8, // Minimum length of 8 characters
                },
                new_password_confirmation: {
                    required: true,
                    equalTo: '#new_password', // Make sure new_password_confirmation matches new_password
                }
            },
            messages: {
                old_password: {
                    required: 'Please enter the old password.',
                },
                new_password: {
                    required: 'Please enter the new password.',
                    minlength: 'Password must be at least 8 characters long.',
                },
                new_password_confirmation: {
                    required: 'Please confirm the new password.',
                    equalTo: 'Password confirmation must match the new password.',
                }
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
