@extends('frontend.frontend_dashboard')
@section('main')
<!--Page Title-->
@include('frontend.home.page_title')
<!--End Page Title-->

<!-- about-section -->
<section class="about-section about-page pb-0">
    <div class="auto-container">
        <div class="content_block_3">
            <div class="content-box">
                <div class="text">
                   {!! $privacy_policy->privacy_policy ?? '' !!}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about-section end -->


<!-- download-section -->
@include('frontend.home.download')
<!-- download-section end -->

@endsection
