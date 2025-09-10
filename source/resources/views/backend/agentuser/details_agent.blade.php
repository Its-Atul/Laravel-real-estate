@extends('admin.admin_dashboard')
@section('title','Agents Details')
@section('admin')
<div class="page-content">
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Agent Details </h6>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Profile Image </td>
                                    <td>
                                        <img src="{{ (!empty($agent->photo)) ? url('upload/admin_images/'.$agent->photo) : url('upload/no_image.jpg') }}"style="width:80px; height:80px;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>User Name </td>
                                    <td><code class="text-wrap">{{ $agent->username ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Name </td>
                                    <td><code>{{ $agent->name ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><code>{{ $agent->email ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td><code>{{ $agent->phone ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Address </td>
                                    <td><code class="text-wrap">{{ $agent->address ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>About </td>
                                    <td><code class="text-wrap">{{ $agent->about ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Social Media Links </td>
                                    <td>
                                        <code>
                                            <div class="d-flex social-links">
                                                <a href="{{ $agent->facebook ?? 'javascript:void(0)' }}" class="btn btn-icon border btn-xs me-2">
                                                    <i data-feather="facebook"></i>
                                                </a>
                                                <a href="{{ $agent->youtube ?? 'javascript:void(0)' }}" class="btn btn-icon border btn-xs me-2">
                                                    <i data-feather="youtube"></i>
                                                </a>
                                                <a href="{{ $agent->twitter ?? 'javascript:void(0)' }}" class="btn btn-icon border btn-xs me-2">
                                                    <i data-feather="twitter"></i>
                                                </a>
                                                <a href="{{ $agent->instagram ?? 'javascript:void(0)' }}" class="btn btn-icon border btn-xs me-2">
                                                    <i data-feather="instagram"></i>
                                                </a>
                                            </div>
                                        </code>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Status </td>
                                    <td>
                                        @if($agent->status == 'active')
                                        <span class="badge rounded-pill bg-success">Active</span>
                                        @else
                                        <span class="badge rounded-pill bg-danger">InActive</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
