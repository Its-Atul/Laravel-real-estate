
@php

    $propertyType = App\Models\PropertyType::orderBy('type_name')->get();
    // Get properties for rent
    $rentproperty = App\Models\Property::where('property_status', 'rent')->where('status','1')->get();

    // Get properties for sale
    $buyproperty = App\Models\Property::where('property_status', 'buy')->where('status','1')->get();

    // Get all amenity
    $amenity = App\Models\Amenities::orderBy('amenitis_name')->get();

    $currency_symbol = App\Models\SiteSetting::find(1);

@endphp

<div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
    <div class="default-sidebar property-sidebar">
        <div class="filter-widget sidebar-widget">
            <div class="widget-title">
                <h5>Property</h5>
            </div>
            <form action="{{ route('all.property.listing') }}" method="GET">
            <div class="widget-content">
                <div class="select-box">
                    <select class="wide" id="country_id">
                        <option selected disabled>Country</option>
                    </select>
                </div>
                <div class="select-box">
                    <select class="wide" id="state_id">
                        <option selected disabled>State</option>

                    </select>
                </div>
                <div class="select-box">
                    <select class="wide" id="city_id">
                        <option selected disabled>City</option>

                    </select>
                </div>
                <div class="select-box">
                    <select class="wide" id="local_area_id">
                        <option selected disabled>Local Area</option>

                    </select>
                </div>

                <div class="select-box">
                    <select class="wide" name="propertyCategory">
                        <option selected disabled>Property Category</option>
                        @foreach ($propertyType as $item )
                            <option value="{{ $item->id }}">{{ $item->type_name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="select-box">
                    <select class="wide" name="propertyType">
                        <option selected disabled>Property Type</option>
                        <option value="buy">{{ 'For Buy' }}</option>
                        <option value="rent">{{ 'For Rent' }}</option>
                    </select>
                </div>
                <div class="filter-btn">
                    <button type="submit" class="theme-btn btn-one"><i class="fas fa-filter"></i>&nbsp;Filter</button>
                </div>
            </div>
            </form>
        </div>
        <div class="price-filter sidebar-widget">
            <div class="widget-title">
                <h5>Select Price Range</h5>
            </div>
            <div class="range-slider clearfix">
                <div class="clearfix">
                    <div class="input">
                        <input type="text" class="property-amount" name="field-name" readonly="">
                    </div>
                </div>
                <form id="price-range-form" action="{{ route('all.property.listing') }}" method="GET">
                    <!-- Price range slider -->
                    <div class="range-slider price-range-slider"></div>

                    <!-- Hidden input fields to store selected price range -->
                    <input type="hidden" id="min-price" name="min_price" value="">
                    <input type="hidden" id="max-price" name="max_price" value="">

                    <!-- Submit button (hidden) -->
                    <button type="submit" style="display: none;"></button>
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
        <div class="category-widget sidebar-widget">
            <div class="widget-title">
                <h5>Amenities</h5>
            </div>
            <ul class="category-list clearfix">
                @foreach ($amenity as $item)
                @php
                $amenityCount = App\Models\Property::whereRaw("FIND_IN_SET(?, amenities_id)", [$item->id])->count();
                $encryptedId = encrypt($item->id);
                @endphp
                <li><a href="{{ url('amenities/'.$encryptedId) }}">{{ $item->amenitis_name }}<span>({{ $amenityCount }})</span></a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
