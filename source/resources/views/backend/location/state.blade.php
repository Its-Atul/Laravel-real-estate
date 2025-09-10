@extends('admin.admin_dashboard')
@section('title','All State')
@section('admin')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            @if(Auth::user()->can('add.state'))
            <button type="button" class="btn btn-inverse-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add State
            </button>
            @endif
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">State</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl </th>
                                    <th>Country Name </th>
                                    <th>State Name </th>
                                    <th>Image </th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($state as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item['country']['name'] ?? ''}}</td>
                                    <td>{{ $item->state_name ?? ''}}</td>
                                    <td>
                                        <img src="{{ (!empty($item->state_image)) ? url($item->state_image) : url('upload/no_image.jpg') }}" width="50px" height="50">
                                    </td>
                                    <td>
                                        @if(Auth::user()->can('edit.state'))
                                        <button type="button" class="btn btn-inverse-warning" data-bs-toggle="modal"
                                            data-bs-target="#locedit" id="{{ $item->id }}"
                                            onclick="locEdit(this.id)"> Edit </button>
                                        @endif
                                        @if(Auth::user()->can('delete.state'))
                                        <a href="{{ route('delete.state',$item->id) }}"
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
                <h5 class="modal-title" id="exampleModalLabel"> Add state</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('store.state') }}" class="forms-sample" id="myForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Select Country </label>
                            <select name="country" class="form-select">
                                <option selected disabled>Select Country</option>
                                @foreach($country as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        @error('country')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">State Name </label>
                        <input type="text" name="name"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label"> Image </label>
                        <input class="form-control @error('state_image') is-invalid @enderror"
                            name="state_image" type="file" id="image">
                        @error('state_image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <img id="showImage" class="rounded-circle" src="{{ url('upload/no_image.jpg') }}"
                            width="50" height="50" alt="profile">
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
                <h5 class="modal-title" id="exampleModalLabel">Edit State</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('update.state') }}" class="forms-sample" id="myFormEdit" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="loc_id" id="loc_id">
                    <div class="form-group mb-3">
                        <label class="form-label">Select Country </label>
                            <select name="country" class="form-select" id="country">

                            </select>
                        @error('country')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">State Name </label>
                        <input type="text" name="name"class="form-control @error('name') is-invalid @enderror" id="state_name">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label"> Image </label>
                        <input class="form-control @error('state_image_edit') is-invalid @enderror" name="state_image_edit" type="file" id="imageEdit">
                        @error('state_image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="imageHidden" id="imageHidden"/>
                        <img id="showImageEdit" class="rounded-circle" src=""  width="50" height="50" >
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--jquery-->
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

<!-- show image js-->

<script type="text/javascript">
    $(document).ready(function(){
        $('#image, #imageEdit').change(function(e){
            var targetSelector = $(this).attr('id') === 'image' ? '#showImage' : '#showImageEdit';
            handleImageChange(e, targetSelector);
        });

        function handleImageChange(e, targetSelector) {
            var reader = new FileReader();
            reader.onload = function(e){
                $(targetSelector).attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>

{{--  Edit Form  --}}
<script type="text/javascript">
    function locEdit(id) {
        $.getJSON('/state/' + id, function (data) {
            $('#state_name').val(data.state_name);
            $('#loc_id').val(data.id);
            $('#imageHidden').val(data.state_image);
            var imageUrl = (data.state_image) ? data.state_image : "{{ url('upload/no_image.jpg') }}";
            $('#showImageEdit').attr('src', imageUrl).width(50).height(50);
            // Populate the country select field
            populateCountrySelect(data.country_id);

        }).fail(function (error) {
            console.log('Error:', error);
            // Handle the error if needed
        });
    }

    function populateCountrySelect(selectedCountryId) {
        $.getJSON('/getCountryShow', function (countries) {
            var countrySelect = $('#country');
            countrySelect.html($.map(countries, function (country) {
                return $('<option>', {
                    value: country.id,
                    text: country.name,
                    selected: country.id == selectedCountryId
                });
            }));
        }).fail(function (error) {
            console.log('Error fetching countries:', error);
            // Handle the error if needed
        });
    }
</script>

<!-- Form Validation-->
<script type="text/javascript">
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
                    state_image: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: 'Please enter state name',
                        maxlength: 'The state name must not be greater than 250 characters.',
                    },

                    country: {
                        required: 'Please select country',

                    },
                    state_image:{

                        required: 'Please choose image',
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
