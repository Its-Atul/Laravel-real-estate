@extends('admin.admin_dashboard')
@section('title','Edit Permission')
@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Permission </h6>
                        <form id="myForm" method="POST" action="{{ route('update.permission') }}" class="forms-sample">
                            @csrf
                            <input type="hidden" name="id" value="{{ $permission->id }}">
                            <div class="form-group mb-3">
                                <label class="form-label">Permission Name </label>
                                <input type="text" name="name" class="form-control" value="{{ $permission->name }}">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Group Name </label>
                                <select name="group_name" class="form-select" >
                                    <option selected="" disabled="">Select Group</option>
                                    <option value="property_type" {{ $permission->group_name == 'property_type' ?
                                        'selected' : ''
                                        }}>Property Type</option>
                                    <option value="location" {{ $permission->group_name == 'location' ? 'selected' : ''
                                        }}>Location</option>
                                    <option value="amenities" {{ $permission->group_name == 'amenities' ? 'selected' :
                                        '' }}>Amenities</option>
                                    <option value="property" {{ $permission->group_name == 'property' ? 'selected' : ''
                                        }}>Property</option>
                                    <option value="history" {{ $permission->group_name == 'history' ? 'selected' : ''
                                        }}>Package History </option>
                                    <option value="message" {{ $permission->group_name == 'message' ? 'selected' : ''
                                        }}>Property Message </option>
                                    <option value="schedule" {{ $permission->group_name == 'schedule' ? 'selected' : ''
                                        }}>Schedule </option>
                                    <option value="contact" {{ $permission->group_name == 'contact' ? 'selected' : ''
                                        }}>Contact</option>
                                    <option value="testimonials" {{ $permission->group_name == 'testimonials' ?
                                        'selected' : '' }}>Testimonials</option>
                                    <option value="agent" {{ $permission->group_name == 'agent' ? 'selected' : ''
                                        }}>Agent</option>
                                    <option value="user" {{ $permission->group_name == 'user' ? 'selected' : ''
                                        }}>User</option>
                                    <option value="admin_user" {{ $permission->group_name == 'admin_user' ? 'selected' :
                                        '' }}>Admin</option>
                                    <option value="blog" {{ $permission->group_name == 'blog' ? 'selected' : ''
                                        }}>Blog</option>

                                    <option value="setting" {{ $permission->group_name == 'setting' ? 'selected' : ''
                                        }}>Setting</option>

                                    <option value="role_permission" {{ $permission->group_name == 'role_permission' ?
                                        'selected' : '' }}>Role
                                        & Permission </option>

                                </select>

                            </div>
                            <button type="submit" class="btn btn-primary me-2">Save Changes </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
