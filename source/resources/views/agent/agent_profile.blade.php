@extends('agent.agent_dashboard')
@section('title', 'Agent Profile')
@section('agent')
<div class="page-content">
    <div class="row profile-body">
        <!-- left wrapper start -->
        <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
            <div class="card rounded">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div>
                            <img class="rounded-circle" src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" width="50px" height="50" alt="profile">
                            <span class="h4 ms-3 ">{{ $profileData->name ?? ''}}</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">User Name:</label>
                        <p class="text-muted">{{ $profileData->username ?? ''}}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                        <p class="text-muted">{{ $profileData->email ?? ''}}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
                        <p class="text-muted">{{ $profileData->phone ?? ''}}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
                        <p class="text-muted">{{ $profileData->address ?? ''}}</p>
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
        <!-- left wrapper end -->
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Update Admin Profile </h6>
                        <form method="POST" action="{{ route('agent.profile.store') }}" class="forms-sample" id="myForm" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" value="{{ $profileData->username ?? ''}}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Name </label>
                                <input type="text" name="name" class="form-control" value="{{ $profileData->name ?? ''}}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Email </label>
                                <input type="email" name="email" class="form-control" value="{{ $profileData->email ?? ''}}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Phone </label>
                                <input type="text" name="phone" class="form-control" value="{{ $profileData->phone ?? ''}}">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Address </label>
                                <textarea name="address" class="form-control" rows="3">{{ $profileData->address ?? ''}}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">About Us</label>
                                <textarea name="about" class="form-control" rows="3">{{ $profileData->about ?? ''}}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Facebook </label>
                                <input type="text" name="facebook" class="form-control"  value="{{ $profileData->facebook ?? ''}}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Twitter </label>
                                <input type="text" name="twitter" class="form-control"  value="{{ $profileData->twitter ?? ''}}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Youtube </label>
                                <input type="text" name="youtube" class="form-control"  value="{{ $profileData->youtube ?? ''}}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Instagram </label>
                                <input type="text" name="instagram" class="form-control"  value="{{ $profileData->instagram ?? ''}}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Photo </label>
                                <input class="form-control" name="photo" type="file" id="image">
                            </div>
                            <div class="form-group mb-3">
                                <img id="showImage" class=" rounded-circle"  src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" width="50px" height="50" alt="profile">
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
    {{--  JQuery   --}}
    <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
    {{--  Image Uploade js  --}}
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

    <!-- Form Validation -->

    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    username: {
                        required: true,
                    },
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    phone: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 10,
                    },
                    address: {
                        maxlength: 255, // Corrected typo
                    },
                    about: {
                        maxlength: 1000, // Corrected typo
                    }
                },
                messages: {
                    username: {
                        required: 'Please enter the username.',
                    },
                    name: {
                        required: 'Please enter the name.',
                    },
                    email: {
                        required: 'Please enter a valid email address.',
                        email: 'Please enter a valid email address.',
                    },
                    phone: {
                        required: 'Please enter a valid phone number.',
                        number: 'Invalid phone number format.',
                        minlength: 'The phone number must be exactly 10 digits.',
                        maxlength: 'The phone number must be exactly 10 digits.',
                    },
                    address: {
                        maxlength: 'The address must not exceed 255 characters.',
                    },
                    about: {
                        maxlength: 'The about field must not exceed 1000 characters.',
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

