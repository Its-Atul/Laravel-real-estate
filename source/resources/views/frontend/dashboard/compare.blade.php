@extends('frontend.frontend_dashboard')
@section('title','Property Compare')
@section('main')
<!--Page Title-->
@include('frontend.home.page_title')
<!--End Page Title-->

<!-- properties-section -->
<section class="properties-section centred">
    <div class="auto-container">
        <div class="table-outer" id="compare">

        </div>
    </div>
</section>
<!-- properties-section end -->
<!-- subscribe-section -->
@include('frontend.dashboard.subscribe')
<!-- subscribe-section end -->

@endsection
