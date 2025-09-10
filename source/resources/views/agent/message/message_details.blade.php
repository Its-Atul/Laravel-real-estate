@extends('agent.agent_dashboard')
@section('title', 'Message Details')
@section('agent')
<div class="page-content">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <h6 class="card-title m-3">Message Details </h6>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Name : </td>
                                <td><code>{{ $msgdetails['user']['name'] ?? '' }}</code></td>
                            </tr>
                            <tr>
                                <td>Email : </td>
                                <td><code>{{ $msgdetails['user']['email'] ?? '' }}</code></td>
                            </tr>

                            <tr>
                                <td>Phone : </td>
                                <td><code>{{ $msgdetails['user']['phone'] ?? '' }}</code></td>
                            </tr>
                            <tr>
                                <td>Property Name : </td>
                                <td><code>{{ $msgdetails['property']['property_name'] ?? '' }}</code></td>
                            </tr>
                            <tr>
                                <td>Property Code : </td>
                                <td><code>{{ $msgdetails['property']['property_code'] ?? '' }}</code></td>
                            </tr>
                            <tr>
                                <td>Property Status : </td>
                                <td><code>{{ $msgdetails['property']['property_status'] ?? '' }}</code></td>
                            </tr>
                            <tr>
                                <td>Message : </td>
                                <td class="text-wrap"><code>{{ $msgdetails['message'] ?? '' }}</code></td>
                            </tr>
                            <tr>
                                <td>Sending Time : </td>
                                <td><code>{{ $msgdetails->created_at->format('l M d') ?? '' }}</code></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
