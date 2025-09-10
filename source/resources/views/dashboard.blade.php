@extends('frontend.frontend_dashboard')
@section('title','Dashboard')
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
                                <h3 class="mb-5">Welcome to Dashboard</h3>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <div class="card-body" style="background-color: #1baf65; display: flex; justify-content: space-between; align-items: center;">
                                            <div class="left-side">
                                                <h1 class="card-title" style="color: white; font-weight: bold;">{{ $wishlistCount ?? '' }}</h1>
                                                <h5 class="card-text" style="color: white;">Wishlist Property</h5>
                                            </div>
                                            <div class="right-side">
                                                <img src="{{ asset('/frontend/assets/images/icons/wishlist.png') }}" width="80" height="80" alt="Image 1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-body" style="background-color: #ffc107; display: flex; justify-content: space-between; align-items: center;">
                                            <div class="left-side">
                                                <h1 class="card-title" style="color: white; font-weight: bold;">{{ $compareCount ?? '' }}</h1>
                                                <h5 class="card-text" style="color: white;">Compare Property</h5>
                                            </div>
                                            <div class="right-side">
                                                <img src="{{ asset('/frontend/assets/images/icons/compare.png') }}" width="80" height="80" alt="Image 1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blog-details-content">
                    <div class="news-block-one">
                        <div class="inner-box">
                            <div class="lower-content">
                                <h3>Schedule A Tour</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Property Name </th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($scheduleTour as $key => $item)
                                        <tr>
                                            <th><p>{{ $key+1 }}</p></th>
                                            <td><p>{{ $item['property']['property_name'] }}</p></td>
                                            <td><p>{{ date('d F Y', strtotime($item->tour_date)) }}</p></td>
                                            <td><p>{{ $item->tour_time }}</p></p></td>
                                            <td>
                                                @if($item->status == 1)
                                                <p class="badge badge-success">Confirm </p>
                                                @else
                                                <p class="badge badge-warning">Pending</p>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
