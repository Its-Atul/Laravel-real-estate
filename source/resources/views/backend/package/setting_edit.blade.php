@extends('admin.admin_dashboard')
@section('title','Edit Package')
@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Package </h6>
                        <form id="myForm" method="POST" action="{{ route('update.package') }}" class="forms-sample">
                            @csrf
                            <input type="hidden" name="id" value="{{ $package->id }}">
                            <div class="form-group mb-3">
                                <label class="form-label">Select Package Name </label>
                                <select name="package_name" id="package_name" class="form-select">
                                    <option value="" disabled selected>Select a Package Name</option>
                                    @foreach ($package_name as $item)
                                        <option value="{{ $item }}" @if($package->package_name == $item) selected @endif>{{ $item }}</option>
                                    @endforeach
                                </select>
                                @error('package_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Package Credits </label>
                                <input type="text" name="package_credits" class="form-control @error('package_credits') is-invalid @enderror" placeholder="Enter Package Credits" value="{{ $package->package_credits ?? '' }}">
                                @error('package_credits')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Package Amount </label>
                                <input type="text" name="package_amount" class="form-control @error('package_amount') is-invalid @enderror" placeholder="Enter Package Amount" value="{{ $package->package_amount ?? '' }}">
                                @error('package_amount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" id="submitBtn" class="btn btn-primary me-2">Save Changes</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- middle wrapper end -->
    </div>
</div>

{{-- JQuery --}}
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

{{-- form validtion --}}
<!-- Form Validation-->
<script type="text/javascript">
    $(document).ready(function () {
        $('#myForm').validate({
            rules: {
                package_name: {
                    required: true,
                },
                package_credits: {
                    required: true,
                    number: true,
                },
                package_amount: {
                    required: true,
                    number: true,
                },
            },
            messages: {
                package_name: {
                    required: 'Please enter the name.',
                },
                package_credits: {
                    required: 'Please enter the credits.',
                    number: 'Invalid credits format.',
                },
                package_amount: {
                    required: 'Please enter the amount.',
                    number: 'Invalid amount format.',
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
            submitHandler: function (form) {
                // Disable the submit button to prevent multiple submissions
                $("#submitBtn").prop("disabled", true);

                // Proceed with form submission
                form.submit();
            }
        });
    });
</script>

@endsection
