@extends('admin.admin_dashboard')
@section('title','All City')
@section('admin')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            @if(Auth::user()->can('add.city'))
            <button type="button" class="btn btn-inverse-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add City
            </button>
            @endif
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">City</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl </th>
                                    <th>Country Name </th>
                                    <th>State Name </th>
                                    <th>City Name </th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($city as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item['state']['country']['name'] ?? '' }}</td>
                                    <td>{{ $item['state']['state_name'] ?? ''}}</td>
                                    <td>{{ $item->name ?? ''}}</td>
                                    <td>
                                        @if(Auth::user()->can('edit.city'))
                                        <button type="button" class="btn btn-inverse-warning" data-bs-toggle="modal"
                                            data-bs-target="#locedit" id="{{ $item->id }}"
                                            onclick="locEdit(this.id)"> Edit </button>
                                        @endif
                                        @if(Auth::user()->can('delete.city'))
                                        <a href="{{ route('delete.city',$item->id) }}"
                                            class="btn btn-inverse-danger" id="delete"> Delete </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Add City</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('store.city') }}" class="forms-sample" id="myForm" >
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Select Country </label>
                            <select name="country" id="country" class="form-select">

                            </select>
                        @error('country')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Select State </label>
                            <select name="state" id="states" class="form-select">

                            </select>
                        @error('state')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">City Name </label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="locedit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit City</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('update.city') }}" class="forms-sample" id="myFormEdit">
                    @csrf
                    <input type="hidden" name="loc_id" id="loc_id">
                    <div class="form-group mb-3">
                        <label class="form-label">Select Country </label>
                            <select name="country" id="countryId" class="form-select">

                            </select>
                        @error('country')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Select State </label>
                            <select name="state" id="state_id" class="form-select">

                            </select>
                        @error('state')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">City Name </label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--jquery -->
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

<script>

    // Dependent Dropdown
    $(document).ready(function () {

        // Fetch and populate countries
        $.ajax({
            url: '/getCountryShow',
            type: 'GET',
            success: function (data) {
                // Clear existing options
                $('#country').empty();

                // Add a default option
                $('#country').append('<option value="" disabled selected>Select Country</option>');
                // Assuming data is an array of objects with 'id' and 'name' properties
                $.each(data, function(index, item) {
                    $('#country').append('<option value="' + item.id + '">' + item.name + '</option>');
                });
            },
            error: function (xhr, status, error) {
                // Handle the error
                console.error("Error fetching countries: " + error);
            }
        });

        // Handle country change event
        $('#country').change(function () {
            var countryId = $(this).val();
            // Fetch and populate states based on the selected country
            $.ajax({
                url: '/getSelectedState/' + countryId,
                type: 'GET',
                success: function (data) {
                 console.log(data);
                    // Clear existing options
                    $('#states').empty();

                    // Add a default option
                    $('#states').append('<option value="" disabled selected>Select state</option>');

                    // Assuming data is an array of objects with 'id' and 'name' properties

                    $.each(data, function(index, item) {
                        // Check if 'state_name' is defined before using it
                        $('#states').append('<option value="' + item.id + '">' + item.state_name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    // Handle the error
                    console.error("Error fetching states: " + error);
                }
            });
        });
    });

    // Edit Form

    // Function to handle location editing
    function locEdit(id) {
        // Get city data
        $.getJSON('/city/' + id, function (data) {
            // Set values in form fields
            $('#loc_id').val(data.id);
            $('#name').val(data.name);

            // Pass the selected country ID to populateStateSelect
            populateStateSelect(data.state_id);
            //console.log('State ids ' + data.state_id);

        }).fail(function (xhr, status, error) {
            console.error("Error fetching city data: " + error);
            // Handle the error if needed
        });
    }

    // Function to populate the country select field
    function populateCountrySelect(selectedCountryId) {
        // Fetch countries data
        $.getJSON('/getCountryShow', function (countries) {
            // Get the country select element
            var countrySelect = $('#countryId');

            // Populate the country select field based on the fetched countries data
            countrySelect.html(countries.map(function (countryItem) {
                // Create an option element for each country
                return $('<option>', {
                    value: countryItem.id,
                    text: countryItem.name,
                    selected: countryItem.id == selectedCountryId
                });
            }));

            // Handle country change event
            countrySelect.change(function () {
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
                        $('#state_id').append('<option value="" disabled selected>Select state</option>');

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

        }).fail(function (error) {
            console.error("Error fetching countries: " + error);
            // Handle the error if needed
        });
    }

    // Function to populate the state select field
    function populateStateSelect(selectedStateId) {
        $.getJSON('/getStateShow', function (states) {
            // Get the state select element
            var stateSelect = $('#state_id');

            // Fetch the associated country_id for the selected state
            var selectedState = states.find(function (stateItem) {
                return stateItem.id == selectedStateId;
            });

            if (selectedState) {
                var selectedCountryId = selectedState.country_id;

                // Call the function to populate the country select field
                populateCountrySelect(selectedCountryId);
            }

            // Filter states based on the selected country_id
            var filteredStates = states.filter(function (stateItem) {
                return stateItem.country_id == selectedCountryId;
            });

            // Populate the state select field with filtered states
            stateSelect.html(filteredStates.map(function (stateItem) {
                // Create an option element for each state
                return $('<option>', {
                    value: stateItem.id,
                    text: stateItem.state_name,
                    selected: selectedStateId == stateItem.id,
                });
            }));
        }).fail(function (error) {
            console.error("Error fetching states: " + error);
            // Handle the error if needed
        });
    }

    // Form Validation
    $(document).ready(function (){
        // Function to initialize validation
        function initializeValidation(formId) {
            $('#' + formId).validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 250,
                    },

                    country: {
                        required: true,
                    },
                    state: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: 'Please enter city name',
                        maxlength: 'The city name must not be greater than 250 characters.',
                    },

                    country: {
                        required: 'Please select country',

                    },
                    state:{

                        required: 'Please select state',
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
            });
        }

        // Initialize validation for the main form
        initializeValidation('myForm');

        // If you have an edit form, initialize validation for it as well
        initializeValidation('myFormEdit');
    });

</script>

@endsection
