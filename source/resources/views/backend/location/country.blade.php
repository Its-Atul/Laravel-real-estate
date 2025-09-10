@extends('admin.admin_dashboard')

@section('title','All Country')
@section('admin')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            @if(Auth::user()->can('add.country'))
            <button type="button" class="btn btn-inverse-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add country
            </button>
            @endif
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Country</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl </th>
                                    <th>Country Name </th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($country as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @if(Auth::user()->can('edit.country'))
                                        <button type="button" class="btn btn-inverse-warning" data-bs-toggle="modal"
                                            data-bs-target="#locedit" id="{{ $item->id }}"
                                            onclick="locEdit(this.id)"> Edit </button>
                                        @endif
                                        @if(Auth::user()->can('delete.country'))
                                        <a href="{{ route('delete.country',$item->id) }}"
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
                <h5 class="modal-title" id="exampleModalLabel"> Add country</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('store.country') }}" class="forms-sample" id="myForm">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Country Name </label>
                        <input type="text" name="name"
                            class="form-control @error('name') is-invalid @enderror">
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
<div class="modal fade" id="locedit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('update.country') }}" class="forms-sample" id="myFormEdit">
                    @csrf
                    <input type="hidden" name="loc_id" id="loc_id">
                    <div class="form-group mb-3">
                        <label class="form-label">Country Name </label>
                        <input type="text" name="name"
                            class="form-control @error('name') is-invalid @enderror" id="loc">
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

<!--jquery-->
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
<script type="text/javascript">
    function locEdit(id){
        $.ajax({
            type: 'GET',
            url: '/country/'+id,
            dataType: 'json',

            success:function(data){
            // console.log(data)
            $('#loc').val(data.name);
            $('#loc_id').val(data.id);
            }
        })
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
                },
                messages: {
                    name: {
                        required: 'Please Enter Country Name',
                        maxlength: 'The Country name must not be greater than 250 characters.',
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
        }

        // Initialize validation for the main form
        initializeValidation('myForm');

        // If you have an edit form, initialize validation for it as well
        initializeValidation('myFormEdit');
    });
</script>

@endsection
