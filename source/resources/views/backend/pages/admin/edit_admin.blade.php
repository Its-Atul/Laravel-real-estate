@extends('admin.admin_dashboard')
@section('title','Edit Admin')
@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Admin </h6>
                        <form id="myForm" method="POST" action="{{ route('update.admin',$user->id) }}"
                            class="forms-sample">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="form-label">Name </label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}">
                             @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Email </label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}">
                             @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Phone </label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $user->phone }}">
                             @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Address </label>
                                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ $user->address }}">
                             @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Select Role </label>
                                <select name="roles" class="form-control @error('roles') is-invalid @enderror" >
                                    <option selected disabled>Select Role</option>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}
                                        >{{ $role->name }}</option>
                                    @endforeach
                                </select>
                             @error('roles')
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
                    required: true,
                    maxlength: 255,
                },

                roles: {
                    required: true,
                },
            },
            messages: {
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
                    required: 'Please enter the address.',
                    maxlength: 'The address must not exceed 255 characters.',
                },

                new_password: {
                    required: 'Please enter the new password.',
                    minlength: 'Password must be at least 8 characters long.',
                },
                new_password_confirmation: {
                    required: 'Please confirm the new password.',
                    equalTo: 'Password confirmation must match the new password.',
                },
                roles: {
                    required: 'Please choose role.',
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
