@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <h6 class="card-title m-3">Contact Details </h6>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Name : </td>
                                <td><code>{{ $contact['username'] ?? '' }}</code></td>
                            </tr>
                            <tr>
                                <td>Email : </td>
                                <td><code>{{ $contact['email'] ?? '' }}</code></td>
                            </tr>

                            <tr>
                                <td>Phone : </td>
                                <td><code>{{ $contact['phone'] ?? '' }}</code></td>
                            </tr>
                            <tr>
                                <td>Subject : </td>
                                <td><code>{{ $contact['subject'] ?? '' }}</code></td>
                            </tr>
                            <tr>
                                <td>Message : </td>
                                <td><code class="text-wrap">{{ $contact['message'] ?? '' }}</code></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
