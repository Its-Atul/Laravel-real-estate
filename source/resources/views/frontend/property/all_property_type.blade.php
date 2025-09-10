@extends('frontend.frontend_dashboard')
@section('title','All property type')
@section('main')
<!--Page Title-->
@include('frontend.home.page_title')
<!--End Page Title-->

<!-- category-section -->
<section class="category-section category-page centred mr-0 pt-120 pb-90">
    <div class="auto-container">
        <div class="inner-container wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
            <ul class="category-list clearfix">
                @foreach ($all_Property_type as $item )
                @php
                $property = App\Models\Property::where('ptype_id',$item->id)->get();
                $encryptedId = encrypt($item->id);
                @endphp
                <li>
                    <div class="category-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="{{ $item->type_icon ?? '' }}"></i></div>
                            <h5><a href="{{ route('property.type',$encryptedId) }}">{{ $item->type_name ?? '' }}</a></h5>
                            <span>{{ count($property ?? '') }}</span>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
<!-- category-section end -->

<!-- cta-section -->
<section class="cta-section alternate-2 centred" style="background-image: url({{ asset('frontend/assets/images/background/cta-1.jpg') }});">
    <div class="auto-container">
        <div class="inner-box clearfix">
            <div class="text">
                <h2>Looking to Buy a New Property or <br />Sell an Existing One?</h2>
            </div>
            <div class="btn-box">
                <a href="{{ route('rent.property') }}" class="theme-btn btn-three">Rent Properties</a>
                <a href="{{ route('buy.property') }}" class="theme-btn btn-one">Buy Properties</a>
            </div>
        </div>
    </div>
</section>
<!-- cta-section end -->
@php
 $property = App\Models\Property::where('status','1')->latest()->limit(3)->get();
@endphp
<!-- feature-section -->
<section class="feature-section sec-pad">
    <div class="auto-container">
        <div class="sec-title centred">
            <h5>Latest Property</h5>
            <h2>Recent Properties</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing sed do eiusmod tempor incididunt <br />labore dolore magna aliqua enim.</p>
        </div>
        <div class="row clearfix">
            @forelse($property as $item)
            @php $encryptedId = encrypt($item->id); @endphp

            <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><img src="{{ asset($item->property_thambnail ?? "image"  ) }}" alt="" style=" height:350px;"></figure>
                            <div class="batch"><i class="icon-11"></i></div>
                            <span class="category">Featured</span>
                        </div>
                        <div class="lower-content">
                            <div class="author-info clearfix">
                                <div class="author pull-left">
                                    <figure class="author-thumb">
                                        <img src="{{ (!empty($item->user->photo)) ? url('upload/admin_images/'.$item->user->photo) : url('upload/no_image.jpg') }}" alt="">
                                    </figure>
                                    <h6>{{ $item->user->name ?? 'user name' }}</h6>
                                </div>
                                <div class="buy-btn pull-right"><a href="javascript:void(0)">For {{ $item->property_status ?? 'property status'}}</a></div>
                            </div>
                            <div class="title-text">
                                <h4><a href="{{ url('property/details/'.$encryptedId.'/'.$item->property_slug) }}">{{ (strlen($item->property_name) > 28) ? substr($item->property_name, 0, 28).'...' : ($item->property_name ? $item->property_name : 'Property name') }}</a></h4>
                            </div>
                            <div class="price-box clearfix">
                                <div class="price-info pull-left">
                                    <h6>Start From</h6>
                                    <h4>{{ $currency_symbol->currency_symbol }}{{ $item->lowest_price ?? '' }}</h4>
                                </div>
                                <ul class="other-option pull-right clearfix">
                                    <li><a aria-label="Compare" class="action-btn" id="{{ $item->id ?? '' }}" onclick="addToCompare(this.id)"><i class="icon-12"></i></a></li>
                                    <li><a aria-label="Add To Wishlist" class="action-btn" id="{{ $item->id ?? '' }}" onclick="addToWishList(this.id)"><i class="icon-13"></i></a></li>
                                </ul>
                            </div>
                            <p>{{ (strlen($item->short_descp) > 108) ? substr($item->short_descp, 0, 108). '....' : ($item->short_descp ? $item->short_descp : 'Short description') }}</p>
                            <ul class="more-details clearfix">
                                <li><i class="icon-14"></i>{{ $item->bedrooms ?? '' }} Beds</li>
                                <li><i class="icon-15"></i>{{ $item->bathrooms ?? '' }} Baths</li>
                                <li><i class="icon-16"></i>{{ $item->property_size ?? '' }} Sq Ft</li>
                            </ul>
                            <div class="btn-box"><a href="{{ url('property/details/'.$encryptedId.'/'.$item->property_slug) }}" class="theme-btn btn-two">See Details</a></div>
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
    </div>
</section>
<!-- feature-section end -->

<!-- subscribe-section -->
@include('frontend.dashboard.subscribe')
<!-- subscribe-section end -->
@endsection
