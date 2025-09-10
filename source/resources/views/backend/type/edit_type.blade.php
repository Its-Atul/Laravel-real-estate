@extends('admin.admin_dashboard')
@section('title','Edit Property Type')
@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Property Type </h6>
                        <form id="myForm" method="POST" action="{{ route('update.type') }}" class="forms-sample">
                            @csrf
                            <input type="hidden" name="id" value="{{ $types->id }}">

                            <div class="form-group mb-3">
                                <label for="exampleInputEmail1" class="form-label">Type Name </label>
                                <input type="text" name="type_name"  class="form-control @error('type_name') is-invalid @enderror " value="{{ $types->type_name }}">
                                @error('type_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="exampleInputEmail1" class="form-label">Type Icon </label>
                                <input type="text" name="type_icon" class="form-control @error('type_icon') is-invalid @enderror " value="{{ $types->type_icon }}">
                                @error('type_icon')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
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
<!--jquery-->
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

<!-- Form Validation-->
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                type_name: {
                    required : true,
                },
                type_icon: {
                    required : true,
                },

            },
            messages :{
                type_name: {
                    required : 'Please enter property type name.',
                },
                type_icon: {
                    required : 'Please enter type icon.',
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
        });
    });
</script>

@endsection
