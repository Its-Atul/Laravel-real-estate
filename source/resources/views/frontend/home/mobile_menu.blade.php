@php
    $setting = App\Models\SiteSetting::find(1);
@endphp
<div class="mobile-menu">
    <div class="menu-backdrop"></div>
    <div class="close-btn"><i class="fas fa-times"></i></div>
    <nav class="menu-box">
        <div class="nav-logo">
            <a href="url('/')">
                <img src="{{ asset($setting->side_header_logo ?? '') }}" alt="" width="214" height='55'></a>
            </a>
        </div>
        <div class="menu-outer">
            <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
        </div>
        <div class="contact-info">
            <h4>Contact Info</h4>
            <ul>
                <li><i class="far fa-map-marker-alt"></i> {{ $setting->company_address ?? '' }}</li>
                <li><i class="far fa-clock"></i> {{ $setting->open_timming ?? '' }}</li>
                <li><i class="far fa-phone"></i><a href="javascript:void(0);"> +{{ $setting->support_phone ?? '' }}</a></li>
            </ul>
        </div>
        <div class="social-links">
            <ul class="clearfix">
                <li><a href="{{ $setting->facebook ?? '' }}"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="{{ $setting->twitter ?? '' }}"><i class="fab fa-twitter"></i></a></li>
                <li><a href="{{ $setting->youtube ?? '' }}"><i class="fab fa-youtube"></i></a></li>
                <li><a href="{{ $setting->instagram ?? '' }}"><i class="fab fa-instagram"></i></a></li>
            </ul>
        </div>
    </nav>
</div>
