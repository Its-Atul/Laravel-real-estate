@extends('agent.agent_dashboard')
@section('title', 'Add Property')
@section('agent')
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Property </h6>
                        <form method="post" action="{{ route('agent.store.property')}}" id="myForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property Name <span>*</span> </label>
                                        <input type="text" name="property_name" class="form-control" placeholder="Enter Property Name" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property Status <span>*</span></label>
                                        <select name="property_status" class="form-select" >
                                            <option selected disabled="">Choose Status</option>
                                            <option value="rent">For Rent</option>
                                            <option value="buy">For Buy</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Lowest Price <span>*</span> </label>
                                        <input type="text" name="lowest_price" class="form-control" placeholder="Enter Lowest Price (e.g., 45,000.00)">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Max Price </label>
                                        <input type="text" name="max_price" class="form-control" placeholder="Enter Max Price (e.g., 45,000.00)">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Main Thambnail <span>*</span> </label>
                                        <input type="file" name="property_thambnail" class="form-control" onChange="mainThamUrl(this)">
                                        <img src="" id="mainThmb">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Multiple Image <span>*</span> </label>
                                        <input type="file" name="multi_img[]" class="form-control" id="multiImg" multiple="">
                                        <div class="row" id="preview_img"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Bedrooms <span>*</span></label>
                                        <input type="text" name="bedrooms" class="form-control" placeholder="Enter number of bedrooms">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Bathrooms <span>*</span></label>
                                        <input type="text" name="bathrooms" class="form-control" placeholder="Enter number of bathrooms">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Garage <span>*</span></label>
                                        <input type="text" name="garage" class="form-control" placeholder="Enter number of garages">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Garage Size <span>*</span></label>
                                        <input type="text" name="garage_size" class="form-control" placeholder="Enter garage size (Sq Ft)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Country <span>*</span></label>
                                        <select class="js-example-basic-single form-select" name="country" id="country_id" data-width="100%">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">State <span>*</span></label>
                                        <select class="js-example-basic-single form-select" name="state" id="state_id" data-width="100%">
                                            <option value="" disabled selected>Select State</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">City <span>*</span></label>
                                        <select class="js-example-basic-single form-select" name="city" id="city_id" data-width="100%">
                                            <option value="" disabled selected>Select City</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Local Area <span>*</span></label>
                                        <select class="js-example-basic-single form-select" name="local_area" id="local_area_id" data-width="100%">
                                            <option value="" selected disabled>Slecte Local Area</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Address <span>*</span></label>
                                        <input type="text" name="address" class="form-control" placeholder="Enter Address">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Postal Code <span>*</span></label>
                                        <input type="text" name="postal_code" class="form-control" placeholder="Enter Postal Code">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property Size <span>*</span></label>
                                        <input type="text" name="property_size" class="form-control" placeholder="Enter Property Size (Sq Ft)">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property YouTube URL <span>*</span></label>
                                        <input type="text" name="property_video" class="form-control" placeholder="Enter YouTube URL">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Neighborhood</label>
                                        <input type="text" name="neighborhood" class="form-control" placeholder="Enter Neighborhood">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Latitude <span>*</span></label>
                                        <input type="text" name="latitude" class="form-control" placeholder="Enter Latitude (e.g., 40.7128)">
                                        <a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Go here to get Latitude from address</a>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Longitude <span>*</span></label>
                                        <input type="text" name="longitude" class="form-control" placeholder="Enter Longitude (e.g., -74.0060)">
                                        <a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Go here to get Longitude from address</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property Type <span>*</span></label>
                                        <select name="ptype_id" class="form-select" >
                                            <option selected="" disabled="">Choose Type</option>
                                            @foreach($propertytype as $ptype)
                                            <option value="{{ $ptype->id }}">{{ $ptype->type_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property Amenities <span>*</span></label>
                                        <select name="amenities_id[]" class="js-example-basic-multiple form-select" multiple="multiple" data-width="100%">
                                            @foreach($amenities as $ameni)
                                            <option value="{{ $ameni->id }}">{{ $ameni->amenitis_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Short Description <span>*</span></label>
                                    <textarea name="short_descp" class="form-control"  rows="3" placeholder="Enter a brief description, e.g., Modern apartment with city view"></textarea>
                                    <span id="charCount" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Long Description <span>*</span></label>
                                    <textarea name="long_descp" class="form-control"  id="tinymceExample" rows="10" placeholder="Provide a detailed description, including features and amenities." ></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group mb-3">
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="featured" value="1" class="form-check-input" id="checkInline1">
                                    <label class="form-check-label" for="checkInline1">
                                        Features Property
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="hot" value="1" class="form-check-input" id="checkInline">
                                    <label class="form-check-label" for="checkInline">
                                        Hot Property
                                    </label>
                                </div>
                            </div>
                            <div class="row add_item">
                                <div class="col-md-5">
                                    <div class="form-group mb-3">
                                        <label  class="form-label"> Nearby Place <span>*</span> </label>
                                        <input type="text" name="facility_name[]" id="facility_name" placeholder="e.g., Park, School, Restaurant" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group mb-3">
                                        <label for="distance" class="form-label"> Distance </label>
                                        <input type="text" name="distance[]" id="distance" class="form-control" placeholder="e.g., 5 (Km)">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3 pt-4">
                                        <span class="btn btn-success addeventmore"><i data-feather="plus-circle"></i></span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" id="submitBtn" class="btn btn-primary mt-3">Save Changes </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- middle wrapper end -->
    </div>
</div>
{{--  //  facility hidden  start  --}}
<div style="visibility: hidden">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="whole_extra_item_delete" id="whole_extra_item_delete">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group mb-3">
                        <input type="text" name="facility_name[]" id="facility_name" placeholder="e.g., Park, School, Restaurant" class="form-control">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group mb-3">
                        <input type="text" name="distance[]" id="distance" class="form-control" placeholder="e.g., 5 (Km)">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group mb-3">
                        <span class="btn btn-danger btn-sm removeeventmore"><i data-feather="minus-circle"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--  //  facility hidden  end  --}}

{{--  Jquery  --}}
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

<script type="text/javascript">

    //  facility add more js
    $(document).ready(function() {
        var counter = 0;
        $(document).on("click", ".addeventmore", function() {
            var whole_extra_item_add = $("#whole_extra_item_add").html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
        });
        $(document).on("click", ".removeeventmore", function(event) {
            $(this).closest("#whole_extra_item_delete").remove();
            counter -= 1
        });
    });

    //  main image js
    function mainThamUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#mainThmb').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    //  multi image js start
    $(document).ready(function() {
        $('#multiImg').on('change', function() { //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function(index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file) { //trigger function on successful read
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(100)
                                    .height(80); //create image element
                                $('#preview_img').append(img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            } else {

                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });

    //  form validation
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                property_name: {
                    required: true,
                },
                property_status: {
                    required: true,
                },
                lowest_price: {
                    required: true,
                    number: true,

                },
                property_thambnail: {
                    required: true,
                },
                'multi_img[]': {
                    required: true,
                },
                bedrooms: {
                    required: true,
                    number: true,
                },
                bathrooms: {
                    required: true,
                    number: true,
                },
                garage: {
                    required: true,
                    number: true,
                },
                garage_size: {
                    required: true,
                    number: true,
                },
                country: {
                    required: true,
                },
                state: {
                    required: true,
                },
                city: {
                    required: true,
                },
                local_area: {
                    required: true,
                },
                address: {
                    required: true,
                },
                postal_code: {
                    required: true,
                    number: true,
                },
                property_size: {
                    required: true,
                    number: true,
                },
                property_video: {
                    required: true,
                    url: true,
                },
                latitude: {
                    required: true,
                },
                longitude: {
                    required: true,
                },
                ptype_id: {
                    required: true,
                },
                'amenities_id[]': {
                    required: true,
                    minlength: 1,
                },
                short_descp: {
                    required: true,
                    maxlength: 500,
                    minlength:105
                },
                long_descp: {
                    required: true,
                    maxlength: 2000,
                },
                'facility_name[]': {
                    required: true,
                    minlength: 1,
                },
                'distance[]': {
                    required: true,
                    number: true,
                },
            },
            messages: {
                property_name: {
                    required: 'Please Enter Property Name',
                },
                property_status: {
                    required: 'Please Select Property Status',
                },
                lowest_price: {
                    required: 'Please Enter Lowest Price',
                    number: 'Please Enter a Valid Number',
                },
                property_thambnail: {
                    required: 'Please Choose Thumbnail Image',
                },
                'multi_img[]': {
                    required: 'Please Choose Multi Image',
                },
                bedrooms: {
                    required: 'Please Enter the Number of Bedrooms',
                    number: 'Please Enter a Valid Number',
                },
                bathrooms: {
                    required: 'Please Enter the Number of Bathrooms',
                    number: 'Please Enter a Valid Number',
                },
                garage: {
                    required: 'Please Enter the Number of Garages',
                    number: 'Please Enter a Valid Number',
                },
                garage_size: {
                    required: 'Please Enter the Garage Size',
                    number: 'Please Enter a Valid Number',
                },
                country: {
                    required: 'Please Select Country',
                },
                state: {
                    required: 'Please Select State',
                },
                city: {
                    required: 'Please Select City',
                },
                local_area: {
                    required: 'Please Select Local Area',
                },
                address: {
                    required: 'Please Enter Address',
                },
                postal_code: {
                    required: 'Please Enter Postal Code',
                    number: 'Please Enter a Valid Number',
                },
                property_size: {
                    required: 'Please Enter Property Size',
                    number: 'Please Enter a Valid Number',
                },
                property_video: {
                    required: 'Please Enter Property Video URL',
                    url: 'Please Enter a Valid URL',
                },
                latitude: {
                    required: 'Please Enter Latitude',
                },
                longitude: {
                    required: 'Please Enter Longitude',
                },
                ptype_id: {
                    required: 'Please Select Property Type',
                },
                'amenities_id[]': {
                    required: 'Please Select at least one Amenity',
                    minlength: 'Please Select at least one Amenity',
                },
                short_descp: {
                    required: 'Please Enter Short Description',
                    maxlength: 'Maximum length is 500 characters',
                    minlength: 'Minimum length is 105 characters',
                },
                long_descp: {
                    required: 'Please Enter Long Description',
                    maxlength: 'Maximum length is 2000 characters',
                },
                'facility_name[]': {
                    required: 'Please Enter Facility Name',
                    minlength: 'Please Enter at least one Facility Name',
                },
                'distance[]': {
                    required: 'Please Enter Distance',
                    number: 'Please Enter a Valid Number',
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
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
    // Dependent Dropdown
    $(document).ready(function () {
        // Fetch and populate countries
        $.ajax({
            url: '/getCountryShow',
            type: 'GET',
            success: function (data) {
                // Clear existing options
                $('#country_id').empty();

                // Add a default option
                $('#country_id').append('<option value="" disabled selected>Select Country</option>');

                // Assuming data is an array of objects with 'id' and 'name' properties
                $.each(data, function(index, item) {
                    $('#country_id').append('<option value="' + item.id + '">' + item.name + '</option>');
                });
            },
            error: function (xhr, status, error) {
                // Handle the error
                console.error("Error fetching countries: " + error);
            }
        });

        // Handle country change event
        $('#country_id').change(function () {
            var countryId = $(this).val();

            // Fetch and populate states based on the selected country
            $.ajax({
                url: '/getSelectedState/' + countryId,
                type: 'GET',
                success: function (data) {
                    console.log(data);
                    // Clear existing options
                    $('#state_id').empty();

                    // Add a default option
                    $('#state_id').append('<option value="" disabled selected>Select State</option>');

                    // Assuming data is an array of objects with 'id' and 'name' properties
                    $.each(data, function(index, item) {
                        // Check if 'state_name' is defined before using it
                        $('#state_id').append('<option value="' + item.id + '">' + item.state_name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    // Handle the error
                    console.error("Error fetching state: " + error);
                }
            });
        });

        // Handle state change event
        $('#state_id').change(function () {
            var stateId = $(this).val();

            // Fetch and populate cities based on the selected state
            $.ajax({
                url: '/getSelectedCity/' + stateId,
                type: 'GET',
                success: function (data) {

                    // Clear existing options
                    $('#city_id').empty();

                    // Add a default option
                    $('#city_id').append('<option value="" disabled selected>Select City</option>');

                    // Assuming data is an array of objects with 'id' and 'name' properties
                    $.each(data, function(index, item) {

                        // Check if 'city_name' is defined before using it
                        $('#city_id').append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    // Handle the error
                    console.error("Error fetching city: " + error);
                }
            });
        });
        // Handle state change event
        $('#city_id').change(function () {
            var cityId = $(this).val();

            // Fetch and populate cities based on the selected state
            $.ajax({
                url: '/getSelectedLocalArea/' + cityId,
                type: 'GET',
                success: function (data) {

                    // Clear existing options
                    $('#local_area_id').empty();

                    // Add a default option
                    $('#local_area_id').append('<option value="" disabled selected>Select Local Area</option>');

                    // Assuming data is an array of objects with 'id' and 'name' properties
                    $.each(data, function(index, item) {

                        // Check if 'city_name' is defined before using it
                        $('#local_area_id').append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    // Handle the error
                    console.error("Error fetching city: " + error);
                }
            });
        });
    });

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
