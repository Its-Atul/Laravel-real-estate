@extends('frontend.frontend_dashboard')
@section('title','Profile')
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
                                <h3>User Profile</h3>
                                <hr class="mb-5">
                                <form action="{{ route('user.profile.store') }}" method="post" class="default-form" enctype="multipart/form-data" id="user_profile">
                                    @csrf
                                    <div class="form-group">
                                        <label>Username <span>*</span></label>
                                        <input type="text" name="username" placeholder="Enter your username" value="{{ $userData->username }}">
                                        @error('username')
                                        <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Name <span>*</span></label>
                                        <input type="text" name="name" placeholder="Enter your name" value="{{ $userData->name }}">
                                        @error('name')
                                        <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Email <span>*</span></label>
                                        <input type="email" name="email" placeholder="Enter your email" value="{{ $userData->email }}">
                                        @error('email')
                                        <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Phone <span>*</span></label>
                                        <input type="text" name="phone" placeholder="Enter your phone number" value="{{ $userData->phone }}">
                                        @error('phone')
                                        <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea name="address" placeholder="Enter your address">{{ $userData->address }}</textarea>
                                        @error('address')
                                        <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Choose Profile Image</label>
                                        <input class="form-control" name="photo" type="file" id="image">
                                        @error('photo')
                                        <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <img id="showImage" src="{{ (!empty($userData->photo)) ? url('upload/user_images/'.$userData->photo) : url('upload/no_image.jpg') }}" alt="" style="width: 50px; height: 50px;"></a>
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">Save Changes</button>
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
