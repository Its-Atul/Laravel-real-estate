@extends('agent.agent_dashboard')
@section('title', 'Edit Property')
@section('agent')
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Property </h6>
                        <form method="post" action="{{ route('agent.update.property') }}" id="myForm">
                            @csrf
                            <input type="hidden" name="id" value="{{ $property->id }}">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property Name <span>*</span></label>
                                        <input type="text" name="property_name" class="form-control" value="{{ $property->property_name }}" placeholder="Enter Property Name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property Status <span>*</span></label>
                                        <select name="property_status" class="form-select"
                                            id="exampleFormControlSelect1">
                                            <option selected="" disabled="">Select Status</option>
                                            <option value="rent" {{ $property->property_status == 'rent' ? 'selected' :
                                                '' }} >For Rent</option>
                                            <option value="buy" {{ $property->property_status == 'buy' ? 'selected' : ''
                                                }}>For Buy</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Lowest Price <span>*</span></label>
                                        <input type="text" name="lowest_price" class="form-control"value="{{ $property->lowest_price }}" placeholder="Enter Lowest Price (e.g., 45,000.00)">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Max Price </label>
                                        <input type="text" name="max_price" class="form-control" value="{{ $property->max_price }}" placeholder="Enter Max Price (e.g., 45,000.00)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">BedRooms <span>*</span></label>
                                        <input type="text" name="bedrooms" class="form-control" value="{{ $property->bedrooms }}" placeholder="Enter number of bedrooms">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Bathrooms <span>*</span></label>
                                        <input type="text" name="bathrooms" class="form-control" value="{{ $property->bathrooms }}" placeholder="Enter number of bathrooms">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Garage <span>*</span></label>
                                        <input type="text" name="garage" class="form-control" value="{{ $property->garage }}" placeholder="Enter number of garages">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Garage Size <span>*</span></label>
                                        <input type="text" name="garage_size" class="form-control" value="{{ $property->garage_size }}" placeholder="Enter garage size (Sq Ft)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Country <span>*</span></label>
                                        <select class="js-example-basic-single form-select" name="country" id="country_id" data-width="100%">
                                            @foreach ($country as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == $property->country_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">State <span>*</span></label>
                                        <select class="js-example-basic-single form-select" name="state" id="state_id" data-width="100%">
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}" {{ $state->id == $property->state_id ? 'selected' : '' }}>{{ $state->state_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">City <span>*</span></label>
                                        <select class="js-example-basic-single form-select" name="city" id="city_id" data-width="100%">
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}" {{ $city->id == $property->city_id ? 'selected' : '' }}>{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Local Area <span>*</span></label>
                                        <select class="js-example-basic-single form-select" name="local_area" id="local_area_id" data-width="100%">
                                            @foreach ($localAreas as $localArea)
                                                <option value="{{ $localArea->id }}" {{ $localArea->id == $property->local_area_id ? 'selected' : '' }}>{{ $localArea->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Address <span>*</span></label>
                                        <input type="text" name="address" class="form-control" value="{{ $property->address }}" placeholder="Enter Address">
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Postal Code <span>*</span></label>
                                        <input type="text" name="postal_code" class="form-control" value="{{ $property->postal_code }}" placeholder="Enter Postal Code">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property Size <span>*</span></label>
                                        <input type="text" name="property_size" class="form-control" value="{{ $property->property_size }}" placeholder="Enter Property Size (Sq Ft)">
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property YouTube URL <span>*</span></label>
                                        <input type="text" name="property_video" class="form-control" value="{{ $property->property_video }}" placeholder="Enter YouTube URL">
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Neighborhood</label>
                                        <input type="text" name="neighborhood" class="form-control" value="{{ $property->neighborhood }}" placeholder="Enter Neighborhood">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Latitude <span>*</span></label>
                                        <input type="text" name="latitude" class="form-control"value="{{ $property->latitude }}" placeholder="Enter Latitude (e.g., 40.7128)">
                                        <a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                            target="_blank">Go here to get Latitude from address</a>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Longitude <span>*</span></label>
                                        <input type="text" name="longitude" class="form-control" value="{{ $property->longitude }}" placeholder="Enter Longitude (e.g., -74.0060)">
                                        <a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                            target="_blank">Go here to get Longitude from address</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property Type <span>*</span> </label>
                                        <select name="ptype_id" class="form-select" id="exampleFormControlSelect1">
                                            <option selected="" disabled="">Select Type</option>
                                            @foreach($propertytype as $ptype)
                                            <option value="{{ $ptype->id }}" {{ $ptype->id == $property->ptype_id ?
                                                'selected' : '' }}>{{ $ptype->type_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property Amenities <span>*</span> </label>
                                        <select name="amenities_id[]" class="js-example-basic-multiple form-select"
                                            multiple="multiple" data-width="100%">
                                            @foreach($amenities as $ameni)
                                            <option value="{{ $ameni->id }}" {{ (in_array($ameni->
                                                id,$property_ami)) ? 'selected' : '' }} >{{
                                                $ameni->amenitis_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Short Description <span>*</span></label>
                                    <textarea name="short_descp" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Enter a brief description, e.g., Modern apartment with city view">{{ $property->short_descp }} </textarea>
                                    <span id="charCount" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Long Description <span>*</span></label>
                                    <textarea name="long_descp" class="form-control" name="tinymce" id="tinymceExample" rows="10" placeholder="Provide a detailed description, including features and amenities.">{!! $property->long_descp !!} </textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group mb-3">
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="featured" value="1" class="form-check-input"
                                        id="checkInline1" {{ $property->featured == '1' ? 'checked' : '' }} >
                                    <label class="form-check-label" for="checkInline1">
                                        Features Property
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="hot" value="1" class="form-check-input"
                                        id="checkInline" {{ $property->hot == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="checkInline">
                                        Hot Property
                                    </label>
                                </div>
                            </div>
                            <button type="submit" id="submitBtn" class="btn btn-primary mt-3" >Save Changes </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- middle wrapper end -->
    </div>
</div>

<!-- Property Main Thambnail Image Update -->

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Main Thambnail Image </h6>
                        <form method="post" action="{{ route('agent.update.property.thambnail') }}" id="myThambnail" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $property->id }}">
                            <input type="hidden" name="old_img" value="{{ $property->property_thambnail }}">
                            <div class="row mb-3">
                                <div class="form-group col-md-6">
                                    <label class="form-label">Main Thambnail <span>*</span></label>
                                    <input type="file" name="property_thambnail" class="form-control mb-3" onChange="mainThamUrl(this)">
                                    <img src="" id="mainThmb">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label"> </label>
                                    <img src="{{ asset($property->property_thambnail) }}"
                                        style="width:100px; height:100px;">
                                </div>
                            </div>
                            <button type="submit" id="submitBtn" class="btn btn-primary">Save Changes </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End  Property Main Thambnail Image Update  -->


<!--  Property Multi Image Update -->
<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Multi Image </h6>
                        <form method="post" action="{{ route('agent.update.property.multiimage') }}" id="myMultiImage" enctype="multipart/form-data">
                            @csrf
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Image</th>
                                            <th>Change Image <span>*</span> </th>
                                            <th>Delete </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($multiImage as $key => $img)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td class="py-1">
                                                <img src="{{ asset($img->photo_name) }}" alt="image"
                                                    style="width:50px; height:50px;">
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                <input type="file" class="form-control" name="multi_img[{{ $img->id }}]">
                                                </div>
                                            </td>
                                            <td>
                                                <input type="submit" name="submitBtn[{{ $img->id }}]" id="submitBtn" class="btn btn-primary px-4" value="Update Image">
                                                <a href="{{ route('property.multiimg.delete',$img->id) }}"
                                                    class="btn btn-danger" id="delete">Delete </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        <form method="post" action="{{ route('agent.store.new.multiimage') }}" id="myNewMultiImage" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="imageid" value="{{ $property->id }}">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <input type="file" class="form-control" name="multi_img">
                                            </div>
                                        </td>
                                        <td>
                                            <input type="submit" id="submitBtn" class="btn btn-info px-4" value="Add Image">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  End Property Multi Image Update -->

<!--  Facility Update -->
<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Nearby Place </h6>
                        <form method="post" action="{{ route('agent.update.property.facilities') }}" id="myFacilityForm">
                            @csrf
                            <input type="hidden" name="id" value="{{ $property->id }}">
                            <div class="row add_item">
                                <div class="whole_extra_item_add" id="whole_extra_item_add">
                                    <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                                        @foreach($facilities as $item)
                                        <div class="container mt-2">
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <input type="text" name="facility_name[]" id="facility_name" placeholder="Enter Place Name *" value="{{ $item->facility_name }}" class="form-control">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="text" name="distance[]" id="distance" class="form-control" placeholder="Distance (Km) *" value="{{ $item->distance }}">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <span class="btn btn-success btn-sm addeventmore"><i data-feather="plus-circle"></i></span>
                                                    <span class="btn btn-danger btn-sm removeeventmore"><i data-feather="minus-circle"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <button type="submit" id="submitBtn" class="btn btn-primary mt-5">Save Changes </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Facility Update -->
{{--  Jquery  --}}
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

<script>
// Facility add more js start
    $(document).ready(function () {
        // Add more functionality on clicking the "Add" button
        $(document).on('click', '.addeventmore', function () {
            var newField = $(".whole_extra_item_add .container:first").clone();
            newField.find('input').val(''); // Clear input values

            $(".whole_extra_item_add").append(newField);
        });

        // Remove functionality on clicking the "Remove" button
        $(document).on('click', '.removeeventmore', function () {
            $(this).closest('.container').remove();
        });
    });
// Facility add more js end

// form validation
$(document).ready(function() {
   // form validate
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
        methods: {
            positiveNumber: function(value, element) {
                return this.optional(element) || parseFloat(value) > 0;
            }
        },
        submitHandler: function(form) {
            // Disable the submit button to prevent multiple submissions
            $("#submitBtn").prop("disabled", true);

            // Proceed with form submission
            form.submit();
        }
    });

    //myThambnail image validation
    $('#myThambnail').validate({
        rules: {
            property_thambnail: {
                required: true,
            },
        },
        messages: {
            property_thambnail: {
                required: 'Please Choose Thumbnail Image',
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
        methods: {
            positiveNumber: function(value, element) {
                return this.optional(element) || parseFloat(value) > 0;
            }
        },
        submitHandler: function(form) {
            // Disable the submit button to prevent multiple submissions
            $("#submitBtn").prop("disabled", true);

            // Proceed with form submission
            form.submit();
        }
    });

   // Initialize multiimage form validation
    $('#myMultiImage').validate({
        errorElement: 'span',
        errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');
        error.insertAfter(element);
        },
        highlight: function(element, errorClass, validClass) {
        $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
        },
        submitHandler: function(form) {
        // Disable the clicked submit button to prevent multiple submissions
        $(":submit").prop("disabled", true);

        // Proceed with form submission
        form.submit();
        }
    });

    // Add click event to each "Update Image" button
    $('[name^="submitBtn"]').click(function() {
        // Extract image ID from the button's name attribute
        var imgId = $(this).attr('name').match(/\[(\d+)\]/)[1];

        // Add rules and messages dynamically based on the clicked button
        $('#myMultiImage').validate().settings.rules['multi_img[' + imgId + ']'] = {
        required: true,
        };

        $('#myMultiImage').validate().settings.messages['multi_img[' + imgId + ']'] = {
        required: 'Please choose an image',
        };

        // Trigger re-validation for the specific field
        $('#myMultiImage').valid();
    });

    //myNewMultiImage image validation
    $('#myNewMultiImage').validate({
        rules: {
            multi_img: {
                required: true,
            },
        },
        messages: {
            multi_img: {
                required: 'Please Choose Image',
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
        methods: {
            positiveNumber: function(value, element) {
                return this.optional(element) || parseFloat(value) > 0;
            }
        },
        submitHandler: function(form) {
            // Disable the submit button to prevent multiple submissions
            $("#submitBtn").prop("disabled", true);

            // Proceed with form submission
            form.submit();
        }
    });


    $('#myFacilityForm').validate({
        rules: {
            'facility_name[]': {
                required: true,
                minlength: 1,
            },
            'distance[]': {
                required: true,
                minlength: 1,
                number: true,
            },

        },
        messages: {

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
// form validation end

// main image js
    function mainThamUrl(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
              $('#mainThmb').attr('src',e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
//main image js  end

//multi image js
$(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                  .height(80); //create image element
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
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
                console.error("Error fetching states: " + error);
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
                console.error("Error fetching cities: " + error);
            }
        });
    });

    // Handle City change event
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
                console.error("Error fetching cities: " + error);
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
