@extends('frontend.frontend_dashboard')
@section('title','Property details')
@section('main')
<!--Page Title-->
@include('frontend.home.page_title')
<!--End Page Title-->

<!-- property-details -->
<section class="property-details property-details-one">
    <div class="auto-container">
        <div class="top-details clearfix">
            <div class="left-column pull-left clearfix">
                <h3>{{ $property->property_name ?? '' }}</h3>
                <div class="author-info clearfix">
                    <div class="author-box pull-left">
                        <figure class="author-thumb">
                            <img src="{{ (!empty($property->user->photo)) ? url('upload/admin_images/'.$property->user->photo) : url('upload/no_image.jpg') }}" alt="">
                        </figure>
                        <h6>{{ $property->user->name ?? 'Name' }}</h6>
                    </div>
                    <ul class="rating clearfix pull-left">
                        <li><i class="icon-39"></i></li>
                        <li><i class="icon-39"></i></li>
                        <li><i class="icon-39"></i></li>
                        <li><i class="icon-39"></i></li>
                        <li><i class="icon-40"></i></li>
                    </ul>
                </div>
            </div>
            <div class="right-column pull-right clearfix">
                <div class="price-inner clearfix">
                    <ul class="category clearfix pull-left">
                        <li><a href="javascript:void(0)">{{ $property->type->type_name ?? '' }}</a></li>
                        <li><a href="javascript:void(0)">For {{ $property->property_status ?? '' }}</a></li>
                    </ul>
                    <div class="price-box pull-right">
                        <h3>{{ $currency_symbol->currency_symbol }}{{ $property->lowest_price ?? '' }}</h3>
                    </div>
                </div>
                <ul class="other-option pull-right clearfix">
                    <li>
                        <!-- Button trigger modal -->
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal"><i class="icon-37"></i></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" onclick="window.print()"><i class="icon-38"></i></a>
                    </li>
                    <li>
                        <a aria-label="Compare" class="action-btn" id="{{ $property->id ?? '' }}"
                            onclick="addToCompare(this.id)"><i class="icon-12"></i></a>
                    </li>
                    <li>
                        <a aria-label="Add To Wishlist" class="action-btn" id="{{ $property->id ?? '' }}"
                            onclick="addToWishList(this.id)"><i class="icon-13"></i></a>
                    </li>
                </ul>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title" id="exampleModalLabel"><strong><i class="icon-37"></i> Share link</strong></span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <ul class="other-option clearfix">
                                {!! $shareComponent !!}
                            </ul>
                        </div>
                    </div>
                </div>
                </div>
                <!-- End Modal -->
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="property-details-content">
                    <div class="carousel-inner">
                        <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">
                            @foreach($multiImage as $img)
                            <figure class="image-box">
                                <img src="{{ asset($img->photo_name ?? '') }}" alt="">
                            </figure>
                            @endforeach
                        </div>
                    </div>
                    <div class="discription-box content-widget">
                        <div class="title-box">
                            <h4>Property Description</h4>
                        </div>
                        <div class="text">
                            <p>{!! $property->long_descp ?? '' !!}</p>
                        </div>
                    </div>
                    <div class="details-box content-widget">
                        <div class="title-box">
                            <h4>Property Details</h4>
                        </div>
                        <ul class="list clearfix">
                            <li>Property ID: <span>{{ $property->property_code ?? '' }}</span></li>
                            <li>Rooms: <span>{{ $property->bedrooms ?? '' }}</span></li>
                            <li>Bathrooms: <span>{{ $property->bathrooms ?? '' }}</span></li>
                            <li>Property Type: <span>{{ $property->type->type_name ?? '' }}</span></li>
                            <li>Property Status: <span>For {{ $property->property_status ?? '' }}</span></li>
                            <li>Property Size: <span>{{ $property->property_size ?? '' }} Sq Ft</span></li>
                            <li>Garage: <span>{{ $property->garage ?? '' }}</span></li>
                            <li>Garage Size: <span>{{ $property->garage_size ?? '' }} Sq Ft</span></li>
                        </ul>
                    </div>
                    <div class="amenities-box content-widget">
                        <div class="title-box">
                            <h4>Amenities</h4>
                        </div>
                        <ul class="list clearfix">
                            @foreach($property_amen as $amen)
                            <li>{{ $amen->amenitis_name ?? '' }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="location-box content-widget">
                        <div class="title-box">
                            <h4>Location</h4>
                        </div>
                        <ul class="info clearfix">
                            <li><span>Address:</span> {{ $property->address ?? '' }}</li>
                            <li><span>Neighborhood:</span> {{ $property->neighborhood ?? '' }}</li>
                            <li><span>Local Area:</span> {{ $property['localArea']['name'] ?? '' }}</li>
                            <li><span>City:</span> {{ $property['localArea']['city']['name'] ?? '' }}</li>
                            <li><span>State:</span> {{ $property['localArea']['city']['state']['state_name'] ?? '' }}</li>
                            <li><span>Country:</span> {{ $property['localArea']['city']['state']['Country']['name'] ?? '' }}</li>
                            <li><span>Zip/Postal Code:</span> {{ $property->postal_code ?? '' }}</li>
                        </ul>
                        <div class="google-map-area">
                            <div class="google-map" id="contact-google-map"
                                data-map-lat="{{ $property->latitude ?? '' }}"
                                data-map-lng="{{ $property->longitude ?? '' }}"
                                data-icon-path="{{ asset('frontend/assets/images/icons/map-marker.png') }}"
                            >
                            </div>
                        </div>
                    </div>
                    <div class="nearby-box content-widget">
                        <div class="title-box">
                            <h4>{{ 'What’s Nearby?' }}</h4>
                        </div>
                        <div class="inner-box">
                            <div class="single-item">
                                <div class="icon-box"><i class="fas fa-book-reader"></i></div>
                                <div class="inner">
                                    <h5>Places:</h5>
                                    @foreach($facility as $item)
                                    <div class="box clearfix">
                                        <div class="text pull-left">
                                            <h6>
                                                {{ $item->facility_name ?? ''}} <span>({{ $item->distance ?? ''}}
                                                    km)</span>
                                            </h6>
                                        </div>
                                        <ul class="rating pull-right clearfix">
                                            <li><i class="icon-39"></i></li>
                                            <li><i class="icon-39"></i></li>
                                            <li><i class="icon-39"></i></li>
                                            <li><i class="icon-39"></i></li>
                                            <li><i class="icon-40"></i></li>
                                        </ul>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="statistics-box content-widget">
                        <div class="title-box">
                            <h4>Property Video </h4>
                        </div>
                        <figure class="image-box">
                            <iframe width="700" height="415" src="{{ $property->property_video ?? '' }}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen>
                            </iframe>
                        </figure>
                    </div>
                    <div class="schedule-box content-widget">
                        <div class="title-box">
                            <h4>Schedule A Tour</h4>
                        </div>
                        <div class="form-inner">
                            <form action="{{ route('store.schedule') }}" method="post" id="schedule-tour">
                                @csrf
                                <input type="hidden" name="property_id" value="{{ $property->id ?? '' }}">
                                <input type="hidden" name="agent_id" value="{{ $property->agent_id ?? '' }}">

                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12 col-sm-12 column">
                                        <div class="form-group">
                                            <i class="far fa-calendar-alt"></i>
                                            <input type="text" name="tour_date" placeholder="Tour Date" id="datepicker">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 column">
                                        <div class="form-group">
                                            <i class="far fa-clock"></i>
                                            <input type="text" name="time" placeholder="Any Time">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 column">
                                        <div class="form-group">
                                            <textarea name="message" placeholder="Your message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 column">
                                        <div class="form-group message-btn">
                                            <button type="submit" class="theme-btn btn-one">Submit Now</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="property-sidebar default-sidebar">
                    <div class="author-widget sidebar-widget">
                        <div class="author-box">
                            <figure class="author-thumb">
                                <img src="{{ (!empty($property->user->photo)) ? url('upload/admin_images/'.$property->user->photo) : url('upload/no_image.jpg') }}" alt="">
                            </figure>
                            <div class="inner">
                                <h4>{{ $property->user->name ?? '' }}</h4>
                                <ul class="info clearfix">
                                    <li><i class="fas fa-map-marker-alt"></i>{{ $property->user->address ?? ''}}</li>
                                    <li><i class="fas fa-phone"></i><a href="javascript:void(0)">{{ $property->user->phone ?? ''}}</a></li>
                                </ul>
                                <div class="btn-box"><a href="{{ url('agent/details/'.$property->user->id) }}">View Listing</a></div>
                            </div>
                        </div>
                        <div class="form-inner">
                            @auth
                            @php
                            $id = Auth::user()->id;
                            $userData = App\Models\User::where('role','user')->where('id',$id)->first();
                            @endphp

                            <form action="{{ route('property.message') }}" method="post" class="default-form" id='agent-message'>
                                @csrf
                                <input type="hidden" name="property_id" value="{{ $property->id ?? '' }}">
                                <input type="hidden" name="agent_id" value="{{ $property->agent_id ?? '' }}">
                                <div class="form-group">
                                    <input type="text" name="msg_name" placeholder="Your name" value="{{ $userData->name ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="msg_email" placeholder="Your Email" value="{{ $userData->email ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="msg_phone" placeholder="Phone" value="{{ $userData->phone ?? ''}}">
                                </div>
                                <div class="form-group">
                                    <textarea name="message" placeholder="Message"></textarea>
                                </div>
                                <div class="form-group message-btn">
                                    <button type="submit" class="theme-btn btn-one">Send Message</button>
                                </div>
                            </form>

                            @else

                            <form action="{{ route('property.message') }}" method="post" class="default-form" id='agent-message'>
                                @csrf

                                <input type="hidden" name="property_id" value="{{ $property->id ?? ''}}">

                                <input type="hidden" name="agent_id" value="{{ $property->agent_id ?? ''}}">

                                <div class="form-group">
                                    <input type="text" name="msg_name" placeholder="Your name" required="">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="msg_email" placeholder="Your Email" required="">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="msg_phone" placeholder="Phone" required="">
                                </div>
                                <div class="form-group">
                                    <textarea name="message" placeholder="Message"></textarea>
                                </div>
                                <div class="form-group message-btn">
                                    <button type="submit" class="theme-btn btn-one">Send Message</button>
                                </div>
                            </form>
                            @endauth
                        </div>
                    </div>
                    <div class="featured-widget sidebar-widget">
                        <div class="widget-title">
                            <h5>Featured Properties</h5>
                        </div>
                        <div class="single-item-carousel owl-carousel owl-theme owl-nav-none dots-style-one">
                            @if(count($featured) > 0)
                                @foreach($featured as $feat)
                                @php $encryptedId = encrypt($feat->id); @endphp
                                    <div class="feature-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="{{ asset($feat->property_thambnail  ) }}" alt="" style="width:370px; height:250px;"></figure>
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
                                    @endforeach
                            @else
                                <div class="feature-block-one">
                                    <div class="alert alert-info text-center">No featured properties found.</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- similar property --}}
        <div class="similar-content">
            <div class="title">
                <h4>Similar Properties</h4>
            </div>
            <div class="row clearfix">
                @if(count($relatedProperty) > 0)
                @foreach($relatedProperty as $item)
                @php $encryptedId = encrypt($item->id); @endphp
                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms"
                        data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image">
                                    <img src="{{ asset($item->property_thambnail ?? ''  ) }}" alt="">
                                </figure>
                                <div class="batch"><i class="icon-11"></i></div>
                                <span class="category">{{ $item->type->type_name ?? '' }}</span>
                            </div>
                            <div class="lower-content">
                                <div class="author-info clearfix">
                                    <div class="author pull-left">
                                        <figure class="author-thumb">
                                            <img src="{{ (!empty($item->user->photo)) ? url('upload/admin_images/'.$item->user->photo) : url('upload/no_image.jpg') }}" alt="">
                                        </figure>
                                        <h6>{{ $item->user->name ?? '' }}</h6>
                                    </div>
                                    <div class="buy-btn pull-right">
                                        <a href="javascript:void(0)">For {{ $item->property_status ?? '' }}</a></div>
                                </div>
                                <div class="title-text">
                                    <h4>
                                        <a href="{{ url('property/details/'.$encryptedId.'/'.$item->property_slug) }}">
                                            {{ (strlen($item->property_name) > 28) ? substr($item->property_name, 0, 28). '...' : ($item->property_name ? $item->property_name :'Property name') }}

                                        </a>
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
                                    <li><i class="icon-14"></i>{{ $item->bedrooms ?? ''}} Beds</li>
                                    <li><i class="icon-15"></i>{{ $item->bathrooms ?? ''}} Baths</li>
                                    <li><i class="icon-16"></i>{{ $item->property_size ?? ''}} Sq Ft</li>
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
                @endforeach
                @else
                <div class="col-12 feature-block">
                    <div class="alert alert-info text-center">No similar properties found.</div>
                </div>
                @endif
            </div>
        </div>

    </div>
</section>
<!-- property-details end -->

<!-- subscribe-section -->
@include('frontend.dashboard.subscribe')
<!-- subscribe-section end -->
@endsection
