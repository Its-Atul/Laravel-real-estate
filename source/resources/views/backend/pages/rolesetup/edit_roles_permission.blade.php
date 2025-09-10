@extends('admin.admin_dashboard')
@section('title','Edit Roles in Permission')
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
                        <h6 class="card-title">Edit Roles in Permission </h6>
                        <form id="myForm" method="POST" action="{{ route('admin.roles.update',$role->id) }}"
                            class="forms-sample">
                            @csrf
                            <div class="form-group mb-3">
                                {{--  <label class="form-label">Roles Name </label>
                                <h3>{{ $role->name }}</h3>  --}}
                                <h6 class="card-title">Roles Name : <span class="text-danger">{{ $role->name }}</span></h6>
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
                                    @php
                                    $permissions = App\Models\User::getpermissionByGroupName($group->group_name)
                                    @endphp
                                    <div class="form-check mb-2">
                                        <h6 class="card-title">{{ str_replace('_',' ',$group->group_name) }} :</h6>
                                    </div>
                                </div>
                                <div class="col-9">
                                    @foreach($permissions as $permission)
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" name="permission[]"
                                            id="checkDefault{{ $permission->id }}" value="{{ $permission->id }}" {{
                                            $role->hasPermissionTo($permission->name) ? 'checked' : '' }} >
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

@endsection
