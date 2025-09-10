@extends('admin.admin_dashboard')
@section('title','All Blog Category')
@section('admin')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            @if(Auth::user()->can('blog.category.add'))
            <button type="button" class="btn btn-inverse-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Category
            </button>
            @endif
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Blog Category All </h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl </th>
                                    <th>Blog Category Name </th>
                                    <th>Blog Category Slug </th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->category_name }}</td>
                                    <td>{{ $item->category_slug }}</td>
                                    <td>
                                        @if(Auth::user()->can('blog.category.edit'))
                                        <button type="button" class="btn btn-inverse-warning" data-bs-toggle="modal"
                                            data-bs-target="#catedit" id="{{ $item->id }}"
                                            onclick="categoryEdit(this.id)"> Edit </button>
                                        @endif
                                        @if(Auth::user()->can('blog.category.delete'))
                                        <a href="{{ route('delete.blog.category',$item->id) }}"
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
                <h5 class="modal-title" id="exampleModalLabel"> Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('store.blog.category') }}" class="forms-sample" id="myForm">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Blog Category Name </label>
                        <input type="text" name="category_name"
                            class="form-control @error('category_name') is-invalid @enderror">
                        @error('category_name')
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
<div class="modal fade" id="catedit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('update.blog.category') }}" class="forms-sample" id="myFormEdit">
                    @csrf
                    <input type="hidden" name="cat_id" id="cat_id">
                    <div class="form-group mb-3">
                        <label class="form-label">Blog Category Name </label>
                        <input type="text" name="category_name"
                            class="form-control @error('category_name') is-invalid @enderror" id="cat">
                        @error('category_name')
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
    function categoryEdit(id){
        $.ajax({
            type: 'GET',
            url: '/blog/category/'+id,
            dataType: 'json',

            success:function(data){
            // console.log(data)
            $('#cat').val(data.category_name);
            $('#cat_id').val(data.id);
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
                    category_name: {
                        required: true,
                        maxlength: 250,
                    },
                },
                messages: {
                    category_name: {
                        required: 'Please Enter Category Name',
                        maxlength: 'The category name must not be greater than 250 characters.',
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
