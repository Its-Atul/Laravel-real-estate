@extends('admin.admin_dashboard')
@section('title','Edit Post')
@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Post </h6>
                        <form id="myForm" method="POST" action="{{ route('update.post') }}" class="forms-sample"  enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $post->id }}">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Post Title </label>
                                        <input type="text" name="post_title" class="form-control @error('post_title') is-invalid @enderror" value="{{ $post->post_title }}">
                                        @error('post_title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Blog Category </label>
                                        <select name="blogcat_id" class="form-control @error('blogcat_id') is-invalid @enderror " id="exampleFormControlSelect1">
                                            <option selected="" disabled="">Select Category</option>
                                            @foreach($blogcat as $cat)
                                            <option value="{{ $cat->id }}" {{ $cat->id == $post->blogcat_id ? 'selected': '' }} >{{ $cat->category_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('blogcat_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Short Description</label>
                                    <textarea name="short_descp" class="form-control @error('short_descp') is-invalid @enderror" rows="3">  {{ $post->short_descp }} </textarea>
                                    @error('short_descp')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <span id="charCount" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Long Description</label>
                                    <textarea name="long_descp" class="form-control @error('long_descp') is-invalid @enderror" id="tinymceExample"  rows="10"> {!! $post->long_descp !!} </textarea>
                                    @error('long_descp')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Post Tags </label>
                                    <input name="post_tags" id="tags" value="{{ $post->post_tags }}" class="form-control @error('post_tags') is-invalid @enderror"/>
                                    @error('post_tags')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Post Photo </label>
                                <input class="form-control @error('post_image') is-invalid @enderror" name="post_image" type="file" id="image">
                                @error('post_image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <img id="showImage" class="rounded-circle" src="{{ asset($post->post_image) }}"  width="50" height="50" alt="profile">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Save Changes </button>
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
<!-- image upload js -->
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
                post_title: {
                    required: true,
                },
                blogcat_id: {
                    required: true,
                },
                short_descp: {
                    required: true,
                    maxlength: 255,
                },
                long_descp: {
                    required: true,
                },
            },
            messages: {
                post_title: {
                    required: 'The post title field is required.',
                },
                blogcat_id: {
                    required: 'The blog category field is required.',
                },
                short_descp: {
                    required: 'The short description field is required.',
                    maxlength: ''The short description must be a maximum of 255 characters long.''
                },
                long_descp: {
                    required: 'The long description field is required.',
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
        });
    });
</script>
<script>
    //count the characters entered in the textarea
    document.addEventListener('DOMContentLoaded', function () {
        var textarea = document.querySelector('textarea[name="short_descp"]');
        var charCount = document.getElementById('charCount');

        textarea.addEventListener('input', function () {
            var count = textarea.value.length;
            charCount.textContent = 'character count: ' + count;
        });
    });
    </script>


@endsection
