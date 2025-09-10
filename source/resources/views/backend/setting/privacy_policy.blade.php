@extends('admin.admin_dashboard')
@section('title','Privacy Policy')
@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Privacy Policy </h6>
                        <form id="myForm" method="POST" action="{{ route('site.update.privacy_policy') }}" class="forms-sample" >
                            @csrf
                            <input type="hidden" name="id" value="{{ $privacy_policy->id ?? ''}}">
                            <div class="form-group col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">Privacy Policy</label>
                                    <textarea name="privacy_policy" class="form-control"  id="tinymceExample" rows="10">{{ $privacy_policy->privacy_policy ?? '' }}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary ">Save Changes </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- middle wrapper end -->
    </div>
</div>
@endsection
