@php
$states = App\Models\State::latest()->get();
$ptypes = App\Models\PropertyType::orderBy('type_name')->get();
$banner = App\Models\Banner::find(1);
$bedrooms = ['1','2','3','4','5','6','7','8','9','10'];
$bathrooms = ['1','2','3','4','5','6','7','8','9','10'];
$currency_symbol = App\Models\SiteSetting::find(1);
$agentName = App\Models\User::where('role','agent')->where('status','active')->orderBy('name')->get();
@endphp
<section class="banner-section" style="background-image: url({{ $banner->banner ?? ''}});">
    <div class="auto-container">
        <div class="inner-container">
            <div class="content-box centred">
                <h2>{{ $banner->heading ?? ""}}</h2>
                <p>{{ $banner->subheading ?? "" }}</p>
            </div>
            <div class="search-field">
                <div class="tabs-box">
                    <div class="tab-btn-box">
                        <ul class="tab-btns tab-buttons centred clearfix">
                            <li class="tab-btn active-btn" data-tab="#tab-1">BUY</li>
                            <li class="tab-btn" data-tab="#tab-2">RENT</li>
                        </ul>
                    </div>
                    <div class="tabs-content info-group">
                        <div class="tab active-tab" id="tab-1">
                            <div class="inner-box">
                                <div class="top-search">
                                    <form action="{{ route('all.property.listing') }}" method="get" class="search-form">
                                        <div class="row clearfix">
                                            <div class="col-lg-6 col-md-12 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Search Property</label>
                                                    <div class="field-input">
                                                        <i class="fas fa-search"></i>
                                                        <input type="hidden" name="propertyType" value="buy">
                                                        <input type="search" name="propertyName" placeholder="Search by Property" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Property Type</label>
                                                    <div class="select-box">
                                                        <select class="wide" name="propertyCategory">
                                                           <option selected disabled >Property Type</option>
                                                           @foreach ($ptypes as $item)
                                                            <option value="{{ $item->id }}">{{ $item->type_name }}</option>
                                                           @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="search-btn">
                                            <button type="submit"><i class="fas fa-search"></i>Search</button>
                                        </div>
                                </div>
                                <div class="switch_btn_one ">
                                    <button class="nav-btn nav-toggler navSidebar-button clearfix search__toggler">Advanced Search<i class="fas fa-angle-down"></i></button>
                                    <div class="advanced-search">
                                        <div class="close-btn">
                                            <a href="#" class="close-side-widget"><i class="far fa-times"></i></a>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-3 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <div class="select-box">
                                                        <select class="wide" name="country" id="country_id">
                                                           <option selected disabled>Country</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <div class="select-box">
                                                        <select class="wide" name="state" id="state_id">
                                                           <option selected disabled>State</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <div class="select-box">
                                                        <select class="wide" name="city" id="city_id">
                                                           <option selected disabled>City</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Local Area</label>
                                                    <div class="select-box">
                                                        <select class="wide" name="local_area" id="local_area_id">
                                                           <option selected disabled>Local Area</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Bedrooms</label>
                                                    <div class="select-box">
                                                        <select class="wide" name="bedrooms">
                                                           <option selected disabled>Bedrooms</option>
                                                           @foreach ($bedrooms as $item )
                                                           <option value="{{ $item }}">{{ $item }} Rooms</option>
                                                           @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Bathrooms</label>
                                                    <div class="select-box">
                                                        <select class="wide" name="bathrooms">
                                                           <option selected disabled>Bathrooms</option>
                                                           @foreach ($bathrooms as $item )
                                                           <option value="{{ $item }}">{{ $item }} Rooms</option>
                                                           @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Agents</label>
                                                    <div class="select-box">
                                                        <select class="wide" name="Agents">
                                                           <option selected disabled>Agents</option>
                                                           @foreach ($agentName as $item )
                                                           <option value="{{ $item->id }}">{{ $item->name}}</option>
                                                           @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="range-box">
                                            <div class="row clearfix">
                                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                    <div class="price-range">
                                                        <h6>Select Price Range</h6>
                                                        <div class="range-input">
                                                            <!-- Hidden input fields to store selected price range -->
                                                            <input type="hidden" id="min-price" name="min_price" value="">
                                                            <input type="hidden" id="max-price" name="max_price" value="">
                                                            <div class="input"><input type="text" class="property-amount" name="property-amount" readonly=""></div>
                                                        </div>
                                                        <div class="price-range-slider"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                    <div class="area-range">
                                                        <h6>Select Property Area</h6>
                                                        <div class="range-input">
                                                            <!-- Hidden input fields to store selected area range -->
                                                            <input type="hidden" id="min-area" name="min_area" value="">
                                                            <input type="hidden" id="max-area" name="max_area" value="">
                                                            <div class="input"><input type="text" class="area-range" name="area-range" readonly=""></div>
                                                        </div>
                                                        <div class="area-range-slider"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab" id="tab-2">
                            <div class="inner-box">
                                <div class="top-search">
                                    <form action="{{ route('all.property.listing') }}" method="get" class="search-form">
                                        <div class="row clearfix">
                                            <div class="col-lg-6 col-md-12 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Search Property</label>
                                                    <div class="field-input">
                                                        <i class="fas fa-search"></i>
                                                        <input type="hidden" name="propertyType" value="rent">
                                                        <input type="search" name="propertyName" placeholder="Search by Property" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Property Type</label>
                                                    <div class="select-box">
                                                        <select class="wide" name="propertyCategory">
                                                           <option selected disabled >Property Type</option>
                                                           @foreach ($ptypes as $item)
                                                            <option value="{{ $item->id }}">{{ $item->type_name }}</option>
                                                           @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="search-btn">
                                            <button type="submit"><i class="fas fa-search"></i>Search</button>
                                        </div>
                                </div>
                                <div class="switch_btn_one ">
                                    <button class="nav-btn nav-toggler navSidebar-button clearfix search__toggler">Advanced Search<i class="fas fa-angle-down"></i></button>
                                    <div class="advanced-search">
                                        <div class="close-btn">
                                            <a href="#" class="close-side-widget"><i class="far fa-times"></i></a>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-3 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <div class="select-box">
                                                        <select class="wide" name="country" id="rent_country_id">
                                                           <option selected disabled>Country</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <div class="select-box">
                                                        <select class="wide" name="state" id="rent_state_id">
                                                           <option selected disabled>State</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <div class="select-box">
                                                        <select class="wide" name="city" id="rent_city_id">
                                                           <option selected disabled>City</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Local Area</label>
                                                    <div class="select-box">
                                                        <select class="wide" name="local_area" id="rent_local_area_id">
                                                           <option selected disabled>Local Area</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Bedrooms</label>
                                                    <div class="select-box">
                                                        <select class="wide" name="bedrooms">
                                                           <option selected disabled>Bedrooms</option>
                                                           @foreach ($bedrooms as $item )
                                                           <option value="{{ $item }}">{{ $item }} Rooms</option>
                                                           @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Bathrooms</label>
                                                    <div class="select-box">
                                                        <select class="wide" name="bathrooms">
                                                           <option selected disabled>Bathrooms</option>
                                                           @foreach ($bathrooms as $item )
                                                           <option value="{{ $item }}">{{ $item }} Rooms</option>
                                                           @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Agents</label>
                                                    <div class="select-box">
                                                        <select class="wide" name="Agents">
                                                           <option selected disabled>Agents</option>
                                                           @foreach ($agentName as $item )
                                                           <option value="{{ $item->id }}">{{ $item->name}}</option>
                                                           @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="range-box">
                                            <div class="row clearfix">
                                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                    <div class="price-range">
                                                        <h6>Select Price Range</h6>
                                                        <div class="range-input">
                                                            <!-- Hidden input fields to store selected price range -->
                                                            <input type="hidden" id="min-price" name="min_price" value="">
                                                            <input type="hidden" id="max-price" name="max_price" value="">
                                                            <div class="input"><input type="text" class="property-amount" name="property-amount" readonly=""></div>
                                                        </div>
                                                        <div class="price-range-slider"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                    <div class="area-range">
                                                        <h6>Select Property Area</h6>
                                                        <div class="range-input">
                                                            <!-- Hidden input fields to store selected area range -->
                                                            <input type="hidden" id="min-area" name="min_area" value="">
                                                            <input type="hidden" id="max-area" name="max_area" value="">
                                                            <div class="input"><input type="text" class="area-range" name="area-range" readonly=""></div>
                                                        </div>
                                                        <div class="area-range-slider"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
