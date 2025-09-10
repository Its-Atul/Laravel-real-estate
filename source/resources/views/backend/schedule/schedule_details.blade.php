@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <h6 class="card-title m-3">Schedule Request Details </h6>
                <form method="post" action="{{ route('admin.update.schedule') }}" id="scheduleForm">
                    @csrf
                    <input type="hidden" name="id" value="{{ $schedule->id ?? ''}}">
                    <input type="hidden" name="email" value="{{ $schedule->user->email ?? ''}}">
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Name :</td>
                                    <td><code>{{ $schedule->user->name ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Name : </td>
                                    <td><code>{{ $schedule->property->property_name ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Tour Date : </td>
                                    <td><code>{{ date('d F Y', strtotime($schedule->tour_date ?? '')) }}</code></td>
                                </tr>
                                <tr>
                                    <td>Tour Time : </td>
                                    <td><code>{{ $schedule->tour_time ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Message : </td>
                                    <td><code class="text-wrap">{{ $schedule->message ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Sending Time : </td>
                                    <td><code>{{ $schedule->created_at->format('l M d Y') ?? ''}}</code></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @if($schedule->status == 0)
                        <button type="submit" id="confirmButton" class="btn btn-success m-3">Request Confirm </button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
{{--  Jquery  --}}
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $("#scheduleForm").submit(function () {
            // Disable the button upon form submission
            $("#confirmButton").prop("disabled", true);
        });
    });
</script>
@endsection
