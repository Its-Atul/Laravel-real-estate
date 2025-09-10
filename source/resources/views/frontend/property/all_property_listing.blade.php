@extends('frontend.frontend_dashboard')
@section('title','Property listing')
@section('main')
<!--Page Title-->
@include('frontend.home.page_title')
<!--End Page Title-->

<!-- property-page-section -->
<section class="property-page-section property-list">
    <div class="auto-container">
        <div class="row clearfix">
        <!-- proerty side bar -->
        @include('frontend.property.property_side_bar')
        <!-- proerty side bar end -->
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="property-content-side">
                    <div class="item-shorting clearfix">
                        <div class="row">
                            <div class="col">
                                <div class="left-column">
                                    <h5>Search Results: <span>{{ "Showing " . $property->firstItem() . "-" . $property->lastItem() . " of " . $property->total() . " Listings" }}</span></h5>
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
                        <div class="deals-list-content list-item">
                            @forelse($property as $item)
                            @php $encryptedId = encrypt($item->id); @endphp
                            <div class="deals-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image">
                                            <img src="{{ asset($item->property_thambnail ?? '') }}" alt="" style=" height:350px;">
                                        </figure>
                                        <div class="batch"><i class="icon-11"></i></div>
                                        <span class="category">Featured</span>
                                        <div class="buy-btn">
                                            <a href="javascript:void(0)">For {{$item->property_status ?? '' }}</a>
                                        </div>
                                    </div>
                                    <div class="lower-content">
                                        <div class="title-text">
                                            <h4>
                                                <a href="{{ url('property/details/'.$encryptedId.'/'.$item->property_slug ) }}">{{ (strlen($item->property_name) > 28) ? substr($item->property_name, 0, 28). '...' : ($item->property_name ? $item->property_name :'Property name') }}</a>
                                            </h4>
                                        </div>
                                        <div class="price-box clearfix">
                                            <div class="price-info pull-left">
                                                <h6>Start From</h6>
                                                <h4>{{ $currency_symbol->currency_symbol }}{{ $item->lowest_price ?? '' }}</h4>
                                            </div>
                                            <div class="author-box pull-right">
                                                <figure class="author-thumb">
                                                    <img src="{{ (!empty($item->user->photo)) ? url('upload/admin_images/'.$item->user->photo) : url('upload/no_image.jpg') }}" alt="">
                                                    <span>{{ $item->user->name ?? 'Agent Name' }}</span>
                                                </figure>
                                            </div>
                                        </div>
                                         <p>{{ (strlen($item->short_descp) > 108) ? substr($item->short_descp, 0, 108). '....' : ($item->short_descp ? $item->short_descp : 'Short description') }}</p>

                                        <ul class="more-details clearfix">
                                            <li><i class="icon-14"></i>{{ $item->bedrooms ?? '' }} Beds</li>
                                            <li><i class="icon-15"></i>{{ $item->bathrooms ?? ''}} Baths</li>
                                            <li><i class="icon-16"></i>{{ $item->property_size ?? '' }} Sq Ft</li>
                                        </ul>
                                        <div class="other-info-box clearfix">
                                            <div class="btn-box pull-left">
                                                <a href="{{ url('property/details/'.$encryptedId.'/'.$item->property_slug) }}" class="theme-btn btn-two">
                                                    See Details
                                                </a>
                                            </div>
                                            <ul class="other-option pull-right clearfix">
                                                <li>
                                                    <a aria-label="Compare" class="action-btn" id="{{ $item->id ?? '' }}" onclick="addToCompare(this.id)"><i class="icon-12"></i></a>
                                                </li>
                                                <li>
                                                    <a aria-label="Add To Wishlist" class="action-btn" id="{{ $item->id ?? '' }}" onclick="addToWishList(this.id)"><i class="icon-13"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <div class="alert alert-info text-center">
                                    No properties found.
                                </div>
                            @endforelse
                        </div>
                        <div class="deals-grid-content grid-item">
                            <div class="row clearfix">
                                @forelse($property as $item)
                                @php $encryptedId = encrypt($item->id); @endphp
                                <div class="col-lg-6 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image">
                                                    <img src="{{ asset($item->property_thambnail ?? '') }}" alt="">
                                                </figure>
                                                <div class="batch"><i class="icon-11"></i></div>
                                                <span class="category">Featured</span>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-info clearfix">
                                                    <div class="author pull-left">
                                                        <figure class="author-thumb">
                                                            <img src="{{ (!empty($item->user->photo)) ? url('upload/admin_images/'.$item->user->photo) : url('upload/no_image.jpg') }}" alt="">
                                                        </figure>
                                                        <h6>{{ $item->user->name ?? 'Agent Name' }}</h6>
                                                    </div>
                                                    <div class="buy-btn pull-right">
                                                        <a href="javascript:void(0)">For {{$item->property_status ?? '' }}</a>
                                                    </div>
                                                </div>
                                                <div class="title-text">
                                                    <h4>
                                                        <a href="{{ url('property/details/'.$encryptedId.'/'.$item->property_slug ) }}">{{ (strlen($item->property_name) > 28) ? substr($item->property_name, 0, 28). '...' : ($item->property_name ? $item->property_name :'Property name') }}</a>
                                                    </h4>
                                                </div>
                                                <div class="price-box clearfix">
                                                    <div class="price-info pull-left">
                                                        <h6>Start From</h6>
                                                        <h4>{{ $currency_symbol->currency_symbol }}{{ $item->lowest_price ?? '' }}</h4>
                                                    </div>
                                                    <ul class="other-option pull-right clearfix">
                                                        <li>
                                                            <a aria-label="Compare" class="action-btn" id="{{ $item->id ?? '' }}" onclick="addToCompare(this.id)"><i class="icon-12"></i></a>
                                                        </li>
                                                        <li>
                                                            <a aria-label="Add To Wishlist" class="action-btn" id="{{ $item->id ?? '' }}" onclick="addToWishList(this.id)"><i class="icon-13"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                 <p>{{ (strlen($item->short_descp) > 108) ? substr($item->short_descp, 0, 108). '....' : ($item->short_descp ? $item->short_descp : 'Short description') }}</p>
                                                <ul class="more-details clearfix">
                                                    <li><i class="icon-14"></i>{{ $item->bedrooms ?? '' }} Beds</li>
                                                    <li><i class="icon-15"></i>{{ $item->bathrooms ?? ''}} Baths</li>
                                                    <li><i class="icon-16"></i>{{ $item->property_size ?? '' }} Sq Ft</li>
                                                </ul>
                                                <div class="btn-box">
                                                    <a href="{{ url('property/details/'.$encryptedId.'/'.$item->property_slug) }}" class="theme-btn btn-two">
                                                        See Details
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                    <div class="alert alert-info">
                                        No properties found.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="pagination-wrapper">
                        {{ $property->links('vendor.pagination.custom') }}
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
