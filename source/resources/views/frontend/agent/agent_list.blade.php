
@extends('frontend.frontend_dashboard')
@section('title','Agent List')
@section('main')
<!--Page Title-->
@include('frontend.home.page_title')
<!--End Page Title-->
<!-- agents-page-section -->
<section class="agents-page-section agents-list">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="default-sidebar agent-sidebar">
                    <div class="agents-search sidebar-widget">
                        <div class="widget-title">
                            <h5>Find Agent</h5>
                        </div>
                        <div class="search-inner">
                            <form action="{{ route('agent.list') }}" method="get">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Enter Agent Name" required="">
                                </div>
                                <div class="form-group">
                                    <button class="theme-btn btn-one">Search Agent</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="category-widget sidebar-widget">
                        <div class="widget-title">
                            <h5>Status Of Property</h5>
                        </div>
                        <ul class="category-list clearfix">
                            <li><a href="{{ route('rent.property') }}">For Rent <span>({{ count($rentproperty) }})</span></a></li>
                            <li><a href="{{ route('buy.property') }}">For Buy <span>({{ count($buyproperty) }})</span></a></li>
                        </ul>
                    </div>
                    <div class="featured-widget sidebar-widget">
                        <div class="widget-title">
                            <h5>Featured Properties</h5>
                        </div>
                        <div class="single-item-carousel owl-carousel owl-theme owl-nav-none dots-style-one">
                            @forelse($featured as $feat)
                            @php $encryptedId = encrypt($feat->id); @endphp
                                <div class="feature-block-one">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <figure class="image"><img src="{{ asset($feat->property_thambnail  ) }}" alt="" style=" height:250px;"></figure>
                                            <div class="batch"><i class="icon-11"></i></div>
                                            <span class="category">Featured</span>
                                        </div>
                                        <div class="lower-content">
                                            <div class="title-text"><h4><a href="{{ url('property/details/'.$encryptedId.'/'.$feat->property_slug) }}">{{ $feat->property_name }}</a></h4></div>
                                            <div class="price-box clearfix">
                                                <div class="price-info">
                                                    <h6>Start From</h6>
                                                    <h4>{{ $currency_symbol->currency_symbol }}{{ $feat->lowest_price }}</h4>
                                                </div>
                                            </div>
                                            <p>{{ (strlen($feat->short_descp) > 0) ? substr($feat->short_descp, 0, 105). '..' : 'Short description' }}</p>
                                            <div class="btn-box"><a href="{{ url('property/details/'.$encryptedId.'/'.$feat->property_slug) }}" class="theme-btn btn-two">See Details</a></div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="alert alert-info text-center">
                                    No properties found.
                                </div>
                                @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="agency-content-side">
                    <div class="item-shorting clearfix">
                        <div class="row">
                            <div class="col">
                                <div class="left-column">
                                    <h5>Search Results: <span>{{ "Showing " . $agents->firstItem() . "-" . $agents->lastItem() . " of " . $agents->total() . " Listings" }}</span></h5>
                                </div>
                            </div>
                            <div class="col">
                                <div class="right-column clearfix">
                                    <div class="short-menu clearfix">
                                        <button class="list-view on"><i class="icon-35"></i></button>
                                        <button class="grid-view"><i class="icon-36"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wrapper list">
                        <div class="agents-list-content list-item">
                            <div class="agents-block-one">
                                @forelse ($agents as $iteam )
                                @php $encryptedId = encrypt($iteam->id); @endphp
                                <div class="inner-box">
                                    <figure class="image-box">
                                        <img src="{{ (!empty($iteam->photo)) ? url('upload/admin_images/'.$iteam->photo) : url('upload/no_image.jpg') }}" alt="" style="width:270px; height:330px;" >
                                    </figure>
                                    <div class="content-box">
                                        <div class="upper clearfix">
                                            <div class="title-inner pull-left">
                                                <h4><a href="{{ route('agent.details',$encryptedId) }}">{{ strlen($iteam->name > 28) ? substr($iteam->name, 0, 28).'...' : ($iteam->name ? $iteam->name : 'Agent name')}}</a></h4>
                                            </div>
                                            <ul class="social-list pull-right clearfix">
                                                <li><a href="{{ $iteam->facebook ?? 'javascript:void(0)' }}"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="{{ $iteam->twitter ?? 'javascript:void(0)' }}"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="{{ $iteam->instagram ?? 'javascript:void(0)' }}"><i class="fab fa-instagram"></i></a></li>
                                                <li><a href="{{ $iteam->youtube ?? 'javascript:void(0)' }}"><i class="fab fa-youtube"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="text">
                                            <p>
                                                {{ (strlen($iteam->about) > 108) ? substr($iteam->about, 0, 108). '....' : ($iteam->about ? $iteam->about : 'Agent about us')  }}
                                            </p>
                                        </div>
                                        <ul class="info clearfix">
                                            <li><i class="fab fa fa-envelope"></i><a href="javascript:void(0)">{{ $iteam->email ?? 'email' }}</a></li>
                                            <li><i class="fab fa fa-phone"></i><a href="javascript:void(0)">{{ $iteam->phone ?? 'phone' }}</a></li>
                                        </ul>
                                        <div class="btn-box">
                                            <a href="{{ route('agent.details',$encryptedId) }}" class="theme-btn btn-two">View Profile</a>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="alert alert-info text-center">
                                    No data found.
                                </div>
                                @endforelse

                            </div>
                        </div>
                        <div class="agents-grid-content">
                            <div class="row clearfix justify-content-center">
                                @forelse ($agents as $iteam )
                                @php $encryptedId = encrypt($iteam->id); @endphp
                                <div class="col-lg-6 col-md-6 col-sm-12 agents-block">
                                    <div class="agents-block-two">
                                        <div class="inner-box">
                                            <figure class="image-box">
                                                <img src="{{ (!empty($iteam->photo)) ? url('upload/admin_images/'.$iteam->photo) : url('upload/no_image.jpg') }}" alt="" style="width:160px; height:160px;" >
                                            </figure>
                                            <div class="content-box">
                                                <div class="title-inner">
                                                    <h4><a href="{{ route('agent.details',$encryptedId) }}">{{ strlen($iteam->name > 28) ? substr($iteam->name, 0, 28).'...' : ($iteam->name ? $iteam->name : 'Agent name')}}</a></h4>
                                                </div>
                                                <div class="text">
                                                    <p>
                                                        {{ (strlen($iteam->about) > 108) ? substr($iteam->about, 0, 108). '....' : ($iteam->about ? $iteam->about : 'Agent about us')  }}
                                                    </p>
                                                </div>
                                                <ul class="info clearfix">
                                                    <li><i class="fab fa fa-envelope"></i><a href="javascript:void(0)">{{ $iteam->email ?? 'email' }}</a></li>
                                                    <li><i class="fab fa fa-phone"></i><a href="javascript:void(0)">{{ $iteam->phone ?? 'phone' }}</a></li>
                                                </ul>
                                                <div class="btn-box">
                                                    <a href="{{ route('agent.details',$encryptedId) }}" class="theme-btn btn-two">View Profile</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="alert alert-info">
                                    No data found.
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="pagination-wrapper">
                        {{ $agents->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- agents-page-section end -->
<!-- subscribe-section -->
@include('frontend.dashboard.subscribe')
<!-- subscribe-section end -->
@endsection
