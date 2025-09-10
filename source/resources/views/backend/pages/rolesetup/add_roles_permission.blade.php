@extends('admin.admin_dashboard')
@section('title','Add Roles in Permission')
@section('admin')

<style type="text/css">
    .form-check-label {
        text-transform: capitalize;
    }
</style>

<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Roles in Permission </h6>
                        <form id="myForm" method="POST" action="{{ route('role.permission.store') }}"
                            class="forms-sample">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="form-label">Roles Name </label>
                                <select name="role_id" class="form-control" >
                                    <option selected="" disabled="">Select Group</option>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="checkDefaultmain">
                                <label class="form-check-label" for="checkDefaultmain">
                                    Permission All
                                </label>
                            </div>
                            <hr>
                            @foreach($permission_groups as $group)
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-check mb-2">
                                        <h6 class="card-title">{{ str_replace('_',' ',$group->group_name) }} :</h6>
                                    </div>
                                </div>
                                <div class="col-9">
                                    @php
                                    $permissions = App\Models\User::getpermissionByGroupName($group->group_name)
                                    @endphp
                                    @foreach($permissions as $permission)
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" name="permission[]"
                                            id="checkDefault{{ $permission->id }}" value="{{ $permission->id }}">
                                        <label class="form-check-label" for="checkDefault{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                    <br>
                                </div>
                            </div>
                            @endforeach
                            <button type="submit" id="submitBtn" class="btn btn-primary me-2">Save Changes </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- middle wrapper end -->
    </div>
</div>
<!-- JQuery -->
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

<script type="text/javascript">
    $('#checkDefaultmain').click(function(){

          if ($(this).is(':checked')) {
            $('input[ type= checkbox]').prop('checked',true);
          }else{
             $('input[ type= checkbox]').prop('checked',false);
          }

        });
</script>

<!-- Form Validation-->
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                role_id: {
                    required: true,
                },
                permission: {
                    required: true,

                },
            },
            messages: {
                role_id: {
                    required: 'Please select group name.',
                },
                permission: {
                    required: 'Permission required.',
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
