@extends('frontend.frontend_dashboard')
@section('title','Property Wishlist')
@section('main')
<!--Page Title-->
@include('frontend.home.page_title')
<!--End Page Title-->
<!-- property-page-section -->
<section class="property-page-section property-list">
    <div class="auto-container">
        <div class="row clearfix">
            <!-- dashboard_sidebar-section -->
            @include('frontend.dashboard.dashboard_sidebar')
            <!-- dashboard_sidebar-section -->
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="property-content-side">
                    <div class="wrapper list">
                        <div class="deals-list-content list-item">
                            <div id="wishlist">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- property-page-section end -->
<!-- subscribe-section -->
@include('frontend.dashboard.subscribe')
<!-- subscribe-section end -->
@endsection
