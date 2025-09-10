@extends('admin.admin_dashboard')
@section('title','Update Banner')
@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Update Banner</h6>
                        <form id="myForm" method="POST" action="{{ route('update.banner') }}" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $banner->id ?? '' }}">

                            <div class="form-group mb-3">
                                <label for="heading" class="form-label">Heading <span>*</span></label>
                                <textarea name="heading" id="heading_id" class="form-control  @error('heading') is-invalid @enderror" rows="3" placeholder="Enter a heading">{{ $banner->heading ?? ''}}</textarea>
                                @error('heading')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="subheading" class="form-label">Sub Heading <span>*</span></label>
                                <textarea name="subheading" id="subheading_id" class="form-control  @error('subheading') is-invalid @enderror" rows="3" placeholder="Enter a subheading">{{ $banner->subheading ?? ''}}</textarea>
                                @error('subheading')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label for="banner" class="form-label">Upload Banner</label>
                                <input class="form-control  @error('banner') is-invalid @enderror"  name="banner" type="file" id="image">
                                @error('banner')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-5">
                                <label for="logo" class="form-label"> </label>
                                <input type="hidden" name="hidden_banner" value="{{ $banner->banner ?? ''}}">
                                <img id="showImage"  src="{{ (!empty($banner->banner)) ? asset($banner->banner) : url('upload/no_image.jpg') }}" width="214" height='55' >
                            </div>
                            <button type="submit" id="submitBtn" class="btn btn-primary ">Save Changes </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- middle wrapper end -->
    </div>
</div>

{{--  Jquery  --}}
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

{{-- Combined Image Upload JS --}}
<script type="text/javascript">
    $(document).ready(function(){
        function setupImageUpload(inputSelector, previewSelector) {
            $(inputSelector).change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $(previewSelector).attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        }

        // Header logo upload
        setupImageUpload('#image', '#showImage');
    });
</script>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                heading_id: {
                    required: true,
                },
                subheading_id: {
                    required: true,
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
