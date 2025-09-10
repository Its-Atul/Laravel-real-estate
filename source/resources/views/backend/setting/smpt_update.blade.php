@extends('admin.admin_dashboard')
@section('title','Smtp Setting')
@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title mb-3">Update Smtp Setting </h6>
                        <form id="myForm" method="POST" action="{{ route('update.smpt.setting') }}" class="forms-sample">
                            @csrf
                            <input type="hidden" name="id" value="{{ $setting->id ?? '' }}">

                            <div class="form-group mb-3">
                                <label class="form-label">Mailer <span>*</span></label>
                                <input type="text" name="mailer" class="form-control @error('mailer') is-invalid @enderror"
                                    value="{{ $setting->mailer ?? '' }}" placeholder="Enter mailer (e.g., smtp)">
                                @error('mailer')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Host <span>*</span></label>
                                <input type="text" name="host" class="form-control @error('host') is-invalid @enderror"
                                    value="{{ $setting->host ?? '' }}" placeholder="Enter host (e.g., smtp.example.com)">
                                @error('host')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Port <span>*</span></label>
                                <input type="text" name="port" class="form-control @error('port') is-invalid @enderror"
                                    value="{{ $setting->port ?? '' }}" placeholder="Enter port (e.g., 587)">
                                @error('port')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Username <span>*</span></label>
                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                                    value="{{ $setting->username ?? '' }}" placeholder="Enter username">
                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Password <span>*</span></label>
                                <input type="text" name="password" class="form-control @error('password') is-invalid @enderror"
                                    value="{{ $setting->password ?? '' }}" placeholder="Enter password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Encryption <span>*</span></label>
                                <input type="text" name="encryption" class="form-control @error('encryption') is-invalid @enderror"
                                    value="{{ $setting->encryption ?? '' }}" placeholder="Enter encryption (e.g., ssl, tls)">
                                @error('encryption')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">From Address <span>*</span></label>
                                <input type="text" name="from_address" class="form-control @error('from_address') is-invalid @enderror"
                                    value="{{ $setting->from_address ?? '' }}" placeholder="Enter from address (e.g., info@example.com)">
                                @error('from_address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" id="submitBtn" class="btn btn-primary me-2">Save Changes</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--jquery-->
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

<!-- Form Validation-->
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                mailer: {
                    required : true,
                    maxlength: 250,
                },
                host: {
                    required : true,
                    maxlength: 250,
                },
                port: {
                    required : true,
                    maxlength: 250,
                },
                username: {
                    required : true,
                    maxlength: 250,
                },
                password: {
                    required : true,
                    maxlength: 250,
                },
                encryption: {
                    required : true,
                    maxlength: 250,
                },
                from_address: {
                    required : true,
                    maxlength: 250,
                },

            },
            messages :{
                mailer: {
                    required : 'Please enter mailer name.',
                    maxlength: 'The mailer name must not be greater than 250 characters.',
                },
                host: {
                    required : 'Please enter host.',
                    maxlength: 'The host must not be greater than 250 characters.',
                },
                port: {
                    required : 'Please enter port.',
                    maxlength: 'The port must not be greater than 250 characters.',
                },
                username: {
                    required : 'Please enter username.',
                    maxlength: 'The username must not be greater than 250 characters.',
                },
                password: {
                    required : 'Please enter password.',
                    maxlength: 'The password must not be greater than 250 characters.',
                },
                encryption: {
                    required : 'Please enter encryption.',
                    maxlength: 'The encryption must not be greater than 250 characters.',
                },
                from_address: {
                    required : 'Please enter from address.',
                    maxlength: 'The from address must not be greater than 250 characters.',
                },

            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
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
