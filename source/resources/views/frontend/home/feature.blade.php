@php
$property = App\Models\Property::where('status','1')->where('featured','1')->latest()->limit(3)->get();
$currency_symbol = App\Models\SiteSetting::find(1);
@endphp
<section class="feature-section sec-pad bg-color-1">
    <div class="auto-container">
        <div class="sec-title centred">
            <h5>Features</h5>
            <h2>Featured Property</h2>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing sed do eiusmod tempor incididunt <br />labore dolore
                magna aliqua enim.
            </p>
        </div>
        <div class="row clearfix">
            @if(count($property) > 0)
            @foreach($property as $item)
            @php $encryptedId = encrypt($item->id); @endphp
            <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
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
                                        <img src="{{ (!empty($item->user->photo)) ? url('upload/admin_images/'.$item->user->photo) : url('upload/no_image.jpg') }}" alt="" width="50px" height="50px">
                                    </figure>
                                    <h6>{{ $item->user->name ?? '' }}</h6>
                                </div>
                                <div class="buy-btn pull-right"><a href="javascript:void(0)">For {{$item->property_status ?? '' }}</a></div>
                            </div>
                            <div class="title-text">
                                <h4>
                                    <a href="{{ url('property/details/'.$encryptedId.'/'.$item->property_slug ) }}">{{ (strlen($item->property_name) > 28) ? substr($item->property_name, 0, 28). '...' : ($item->property_name ? $item->property_name :'Property name') }}</a>
                                </h4>
                            </div>
                            <div class="price-box clearfix">
                                <div class="price-info pull-left">
                                    <h6>Start From</h6>
                                    <h4>{{ $currency_symbol->currency_symbol  }}{{ $item->lowest_price ?? '' }}</h4>
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
            @endforeach
            @else
                <div class="col-12 feature-block">
                    <div class="alert alert-info text-center">No featured properties found.</div>
                </div>
            @endif
        </div>
        <div class="more-btn centred">
            <a href="{{ route('all.property.listing') }}" class="theme-btn btn-one">
                View All Listing
            </a>
        </div>
    </div>
</section>
