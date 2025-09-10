@extends('frontend.frontend_dashboard')
@section('main')
@section('title','Tour Schedule')
<!--Page Title-->
@include('frontend.home.page_title')
<!--End Page Title-->


<!-- sidebar-page-container -->
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
                                <h3>Tour Schedule</h3>
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
                                            @foreach($srequest as $key => $item)
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
<!-- sidebar-page-container -->
<!-- subscribe-section -->
@include('frontend.dashboard.subscribe')
<!-- subscribe-section end -->


@endsection
