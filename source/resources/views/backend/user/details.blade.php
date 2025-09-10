@extends('admin.admin_dashboard')
@section('title','User Details')
@section('admin')
<div class="page-content">
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">User Details </h6>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Profile Image : </td>
                                    <td>
                                        <img src="{{ (!empty($user->photo)) ? url('upload/user_images/'.$user->photo) : url('upload/no_image.jpg') }}"style="width:80px; height:80px;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>User Name : </td>
                                    <td><code class="text-wrap">{{ $user->username ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Name : </td>
                                    <td><code>{{ $user->name ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Email :</td>
                                    <td><code>{{ $user->email ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Phone :</td>
                                    <td><code>{{ $user->phone ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Address :</td>
                                    <td><code class="text-wrap">{{ $user->address ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Status : </td>
                                    <td>
                                        @if($user->status == 'active')
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
