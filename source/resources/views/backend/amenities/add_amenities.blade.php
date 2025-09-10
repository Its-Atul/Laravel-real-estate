@extends('admin.admin_dashboard')
@section('title','Add Amenitie')
@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Amenities </h6>
                        <form id="myForm" method="POST" action="{{ route('store.amenitie') }}" class="forms-sample">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="form-label">Amenities Name </label>
                                <input type="text" name="amenitis_name" class="form-control @error('type_name') is-invalid @enderror" >
                                @error('amenitis_name')
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

<!--jquery-->
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

<!-- Form Validation-->
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                amenitis_name: {
                    required : true,
                    maxlength: 250,
                },

            },
            messages :{
                amenitis_name: {
                    required : 'Please Enter Amenities Name',
                    maxlength: 'The amenities name must not be greater than 250 characters.',
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
