@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Testimonial </h6>
                        <form id="myForm" method="POST" action="{{ route('store.testimonials') }}" class="forms-sample"  enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label class="form-label"> Name </label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror ">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label"> Position </label>
                                <input type="text" name="position" class="form-control @error('position') is-invalid @enderror ">
                                @error('position')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label"> Message </label>
                                <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="3"></textarea>
                                @error('message')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Tentimonial Photo </label>
                                <input class="form-control @error('image') is-invalid @enderror" name="image" type="file" id="image">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="form-group mb-3">
                                <img id="showImage" class="wd-50 rounded-circle" src="{{ url('upload/no_image.jpg') }}" alt="profile">
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

<!--Jquery-->
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

<!-- image upload js-->
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

<!-- Form Validation-->
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 255,
                },
                position: {
                    required: true,
                    maxlength: 255,
                },
                message: {
                    required: true,
                    maxlength: 255,
                },
                image: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: 'Please Enter Name',
                    maxlength: 'The name must not be greater than 255 characters.',
                },
                position: {
                    required: 'Please Enter Position',
                    maxlength: 'The position must not be greater than 255 characters.',
                },
                message: {
                    required: 'Please Enter Message',
                    maxlength: 'The message must not be greater than 255 characters.',
                },
                image: {
                    required: 'Please Upload an Image',
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
