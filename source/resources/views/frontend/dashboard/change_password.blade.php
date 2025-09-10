@extends('frontend.frontend_dashboard')
@section('title','Change Password')
@section('main')
<!--Page Title-->
@include('frontend.home.page_title')
<!--End Page Title-->

<!-- page-container -->
<section class="sidebar-page-container blog-details sec-pad-2">
    <div class="auto-container">
        <div class="row clearfix">
            <!-- sidebar-bar-page-container -->
             @include('frontend.dashboard.dashboard_sidebar')
            <!-- sidebar-page-container -->
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-details-content">
                    <div class="news-block-one">
                        <div class="inner-box">
                            <div class="lower-content">
                                <h3>Change Password </h3>
                                <hr class="mb-5">
                                <form action="{{ route('user.password.update') }}" method="post" class="default-form" id="change_password">
                                    @csrf
                                    <div class="form-group">
                                        <label>Old Password <span>*</span></label>
                                        <input type="password" name="old_password" id="old_password" placeholder="Enter old password">
                                        @error('old_password')
                                        <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>New Password <span>*</span></label>
                                        <input type="password" name="new_password" id="new_password" placeholder="Enter your new password">
                                        @error('new_password')
                                        <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm New Password <span>*</span></label>
                                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="Enter confirm password">
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">Save Changes </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- page-container -->

<!-- subscribe-section -->
@include('frontend.dashboard.subscribe')
<!-- subscribe-section end -->

@endsection
