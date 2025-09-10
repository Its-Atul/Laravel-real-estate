@php
$setting = App\Models\SiteSetting::find(1);
@endphp
<header class="main-header">
    <!-- header-top -->
    <div class="header-top">
        <div class="top-inner clearfix">
            <div class="left-column pull-left">
                <ul class="info clearfix">
                    <li><i class="far fa-map-marker-alt"></i>{{ $setting->company_address ?? ''}}</li>
                    <li><i class="far fa-clock"></i>{{ $setting->open_timming ?? ''}}</li>
                    <li><i class="far fa-phone"></i><a href="javascript:void(0);">+{{ $setting->support_phone ?? ''}}</a></li>
                </ul>
            </div>
            <div class="right-column pull-right">
                <ul class="social-links clearfix">
                    <li><a href="{{ $setting->facebook ?? ''}}"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="{{ $setting->twitter ?? ''}}"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="{{ $setting->youtube ?? ''}}"><i class="fab fa-youtube"></i></a></li>
                    <li><a href="{{ $setting->instagram ?? ''}}"><i class="fab fa-instagram"></i></a></li>
                </ul>
                @auth
                <div class="sign-box">
                    @if(Auth::user()->role === 'agent')
                    <a href="{{ route('agent.dashboard') }}"><i class="fa fa-tachometer"></i>Dashboard</a>
                    @elseif (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"><i class="fa fa-tachometer"></i>Dashboard</a>
                    @else
                    <a href="{{ route('dashboard') }}"><i class="fa fa-tachometer"></i>Dashboard</a>
                    @endif
                </div>
                @else
                <div class="sign-box">
                    <a href="{{ route('login') }}"><i class="fas fa-user"></i>Sign In</a>
                </div>
                @endauth
            </div>
        </div>
    </div>
    <!-- header-lower -->
    <div class="header-lower">
        <div class="outer-box">
            <div class="main-box">
                <div class="logo-box">
                    <figure class="logo">
                        <a href="{{ url('/') }}"><img src="{{ asset($setting->logo ?? '') }}" width="214" height='55' alt=""></a>
                    </figure>
                </div>
                <div class="menu-area clearfix">
                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler">
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                    </div>
                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li><a href="{{ url('/') }}"><span>Home</span></a> </li>
                                <li><a href="{{ route('about.us') }}"><span>About Us </span></a> </li>
                                <li class="dropdown"><a href="{{ route('all.property.listing') }}"><span>Property</span></a>
                                    <ul>
                                        <li><a href="{{ route('rent.property') }}">Rent Property</a></li>
                                        <li><a href="{{ route('buy.property') }}">Buy Property </a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('agent.list') }}"><span>Agent </span></a> </li>
                                <li><a href="{{ route('blog.list') }}"><span>Blog </span></a> </li>
                                <li><a href="{{ route('contact.us') }}"><span>Contact</span></a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!--sticky Header-->
    <div class="sticky-header">
        <div class="outer-box">
            <div class="main-box">
                <div class="logo-box">
                    <figure class="logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset($setting->logo ?? '') }}" alt="" width="214" height='55'></a>
                    </figure>
                </div>
                <div class="menu-area clearfix">
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
