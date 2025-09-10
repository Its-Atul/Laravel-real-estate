@extends('admin.admin_dashboard')
@section('title','Term Service')
@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Term Service </h6>
                        <form id="myForm" method="POST" action="{{ route('site.update.term_service') }}" class="forms-sample" >
                            @csrf
                            <input type="hidden" name="id" value="{{ $term_service->id ?? ''}}">
                            <div class="form-group col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">Term Service</label>
                                    <textarea name="term_service" class="form-control"  id="tinymceExample" rows="10">{{ $term_service->term_service ?? ''}}</textarea>
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
