@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Testimonial </h6>
                        <form id="myForm" method="POST" action="{{ route('update.testimonials') }}" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $testimonial->id }}">
                            <div class="form-group mb-3">
                                <label class="form-label"> Name </label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $testimonial->name }}">
                                 @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label"> Position </label>
                                <input type="text" name="position" class="form-control @error('position') is-invalid @enderror " value="{{ $testimonial->position }}">
                                 @error('position')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label"> Message </label>
                                <textarea name="message" class="form-control @error('message') is-invalid @enderror"  rows="3">{{ $testimonial->message }}</textarea>
                                 @error('message')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Tentimonial Photo </label>
                                <input name="hidden_image" type="hidden" value="{{$testimonial->image}}">
                                <input class="form-control @error('image') is-invalid @enderror" name="image" type="file" id="image">
                                 @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <img id="showImage" class="wd-50 rounded-circle" src="{{ asset($testimonial->image) }}"  alt="profile">
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

<!-- Jquery -->

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


@endsection
