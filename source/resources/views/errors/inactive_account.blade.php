@extends('frontend.frontend_dashboard')
@section('title','Forbidden')
@section('main')
<!--Page Title-->
<section class="page-title-two bg-color-1 centred">
    <div class="pattern-layer">
        <div class="pattern-1" style="background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }});">
        </div>
        <div class="pattern-2" style="background-image: url({{ asset('frontend/assets/images/shape/shape-10.png') }});">
        </div>
    </div>
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>403</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>403</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->
<!-- error-section -->
<section class="error-section centred">
    <div class="auto-container">
        <div class="inner-box">
            <h1>403</h1>
            <h2>Access forbidden.<br>Your account is inactive.</h2>
            <p class="text-warning mb-3 "><strong>Contact the administrator to activate your account.</strong></p>
            <button class="theme-btn btn-one" onclick="history.back()">Go Back</button>
        </div>
    </div>
</section>
<!-- error-section end -->
@endsection
