@extends('frontend.frontend_dashboard')
@section('title','Login')
@section('main')
<!--Page Title-->
@include('frontend.home.page_title')
<!--End Page Title-->

<!-- ragister-section -->
<section class="ragister-section centred sec-pad">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-xl-8 col-lg-12 col-md-12 offset-xl-2 big-column">
                <div class="sec-title">
                    <h5>Sign in</h5>
                    <h2>Sign In With {{ $sitesetting->company_name }}</h2>
                </div>
                <div class="tabs-box">
                    <div class="tabs-content">
                        <div class="tab active-tab">
                            <div class="inner-box">
                                <h4>Sign in</h4>
                                <form action="{{ route('login') }}" method="post" class="default-form" id="signin">
                                    @csrf
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input type="email" name="email" value="{{ old('email') }}">
                                        @error('email')
                                        <label>{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password"  value="{{ old('password') }}">
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">Sign in</button>
                                    </div>
                                </form>
                                <div class="othre-text">
                                    <p>Have not any account? <a href="{{ route('register') }}">Register Now</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ragister-section end -->


<!-- subscribe-section -->
@include('frontend.dashboard.subscribe')
<!-- subscribe-section end -->

@endsection
