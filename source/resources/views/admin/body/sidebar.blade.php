<nav class="sidebar">
    @php
    $cname = App\Models\SiteSetting::find('1');
    @endphp
    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
           {{ strtoupper($cname->company_name ?? 'Text Here') }}
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            {{-- Dashboard --}}
            <li class="nav-item @if(Route::currentRouteName() === 'admin.dashboard') active @endif">
                <a href="{{ route('admin.dashboard') }}" class="nav-link @if(Route::currentRouteName() === 'admin.dashboard') active @endif">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item nav-category">RealEstate</li>

            {{-- Property type --}}
            @if(Auth::user()->can('property.type.menu'))
            <li class="nav-item @if(Route::currentRouteName() === 'add.type' || Route::currentRouteName() === 'all.type') active @endif">
                <a class="nav-link" data-bs-toggle="collapse" href="#PropertyType" role="button" aria-expanded="false"
                    aria-controls="PropertyType">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Property Type </span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse @if(Route::currentRouteName() === 'add.type' || Route::currentRouteName() === 'all.type') show @endif" id="PropertyType">
                    <ul class="nav sub-menu">
                        @if(Auth::user()->can('property.type.all'))
                        <li class="nav-item">
                            <a href="{{ route('all.type') }}" class="nav-link @if(Route::currentRouteName() === 'all.type') active @endif">All Type</a>
                        </li>
                        @endif
                        @if(Auth::user()->can('property.type.add'))
                        <li class="nav-item">
                            <a href="{{ route('add.type') }}" class="nav-link @if(Route::currentRouteName() === 'add.type') active @endif">Add Type</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif

            {{-- Amenitie --}}
            @if(Auth::user()->can('amenitie.menu'))
            <li class="nav-item @if(Route::currentRouteName() === 'all.amenitie' || Route::currentRouteName() === 'add.amenitie') active @endif">
                <a class="nav-link" data-bs-toggle="collapse" href="#amenitie" role="button" aria-expanded="false"
                    aria-controls="amenitie">
                    <i class="link-icon" data-feather="coffee"></i>
                    <span class="link-title">Amenitie </span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse @if(Route::currentRouteName() === 'all.amenitie' || Route::currentRouteName() === 'add.amenitie') show @endif" id="amenitie">
                    <ul class="nav sub-menu">
                        @if(Auth::user()->can('amenitie.all'))
                        <li class="nav-item">
                            <a href="{{ route('all.amenitie') }}" class="nav-link @if(Route::currentRouteName() === 'all.amenitie') active @endif">All Amenitie</a>
                        </li>
                        @endif
                        @if(Auth::user()->can('amenitie.add'))
                        <li class="nav-item">
                            <a href="{{ route('add.amenitie') }}" class="nav-link @if(Route::currentRouteName() === 'add.amenitie') active @endif">Add Amenitie</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif
            {{-- Location --}}
            @if(Auth::user()->can('location.menu'))
            <li class="nav-item @if(Route::currentRouteName() === 'country' || Route::currentRouteName() === 'state' || Route::currentRouteName() === 'city' || Route::currentRouteName() === 'local.area') active @endif">
                <a class="nav-link" data-bs-toggle="collapse" href="#state" role="button" aria-expanded="false"
                    aria-controls="state">
                    <i class="link-icon" data-feather="map"></i>
                    <span class="link-title">Location</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse  @if(Route::currentRouteName() === 'country' || Route::currentRouteName() === 'state' || Route::currentRouteName() === 'city' || Route::currentRouteName() === 'local.area') show @endif" id="state">
                    <ul class="nav sub-menu">
                        @if(Auth::user()->can('country'))
                        <li class="nav-item @if(Route::currentRouteName() === 'country') active @endif">
                            <a href="{{ route('country') }}" class="nav-link @if(Route::currentRouteName() === 'country') active @endif">Country</a>
                        </li>
                        @endif
                        @if(Auth::user()->can('state'))
                        <li class="nav-item @if( Route::currentRouteName() === 'state') active @endif">
                            <a href="{{ route('state') }}" class="nav-link @if( Route::currentRouteName() === 'state') active @endif ">State</a>
                        </li>
                        @endif
                        @if(Auth::user()->can('city'))
                        <li class="nav-item @if(Route::currentRouteName() === 'city') active @endif">
                            <a href="{{ route('city') }}" class="nav-link  @if(Route::currentRouteName() === 'city') active @endif">City</a>
                        </li>
                        @endif
                        @if(Auth::user()->can('local_area'))
                        <li class="nav-item @if(Route::currentRouteName() === 'local.area') active @endif">
                            <a href="{{ route('local.area') }}" class="nav-link @if(Route::currentRouteName() === 'local.area') active @endif">Local Area</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif

            {{-- Property --}}
            @if(Auth::user()->can('property.menu'))
            <li class="nav-item @if(Route::currentRouteName() === 'all.property' || Route::currentRouteName() === 'add.property' ) active @endif">
                <a class="nav-link" data-bs-toggle="collapse" href="#property" role="button" aria-expanded="false"
                    aria-controls="amenitie">
                    <i class="link-icon" data-feather="home"></i>
                    <span class="link-title">Property </span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse @if(Route::currentRouteName() === 'all.property' || Route::currentRouteName() === 'add.property' ) show @endif" id="property">
                    <ul class="nav sub-menu">
                        @if(Auth::user()->can('property.all'))
                        <li class="nav-item @if(Route::currentRouteName() === 'all.property' ) active @endif ">
                            <a href="{{ route('all.property') }}" class="nav-link @if(Route::currentRouteName() === 'all.property' ) active @endif">All Property</a>
                            @endif
                        </li>
                        @if(Auth::user()->can('property.add'))
                        <li class="nav-item @if(Route::currentRouteName() === 'add.property' ) active @endif">
                            <a href="{{ route('add.property') }}" class="nav-link @if(Route::currentRouteName() === 'add.property' ) active @endif">Add Property</a>
                            @endif
                        </li>
                    </ul>
                </div>
            </li>
            @endif

            {{-- Package History --}}
            @if(Auth::user()->can('package.history'))
            <li class="nav-item @if(Route::currentRouteName() === 'admin.package.history' ) active @endif">
                <a href="{{ route('admin.package.history') }}" class="nav-link @if(Route::currentRouteName() === 'admin.package.history' ) active @endif">
                    <i class="link-icon" data-feather="clock"></i>
                    <span class="link-title">Package History</span>
                </a>
            </li>
            @endif

            {{-- Property Message --}}
            @if(Auth::user()->can('message.all'))
            @php
            $messageCount = App\Models\PropertyMessage::where('admin_status','unread')->count();
            @endphp
            <li class="nav-item @if(Route::currentRouteName() === 'admin.property.message' ) active @endif">
                <a href="{{ route('admin.property.message') }}" class="nav-link @if(Route::currentRouteName() === 'admin.property.message' ) active @endif">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Property Message </span>
                </a>
                @if($messageCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $messageCount }}
                    </span>
                @endif
            </li>
           @endif

            {{-- Schedule --}}
            @if(Auth::user()->can('schedule.all'))
            @php
            $scheduleCount = App\Models\Schedule::where('status','0')->count();
            @endphp
            <li class="nav-item @if(Route::currentRouteName() === 'admin.schedule.request' ) active @endif">
                <a href="{{ route('admin.schedule.request') }}" class="nav-link @if(Route::currentRouteName() === 'admin.schedule.request' ) active @endif">
                <i class="link-icon" data-feather="calendar"></i>
                <span class="link-title">Tour Schedule</span>
                </a>
                @if($scheduleCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $scheduleCount }}
                    </span>
                @endif
            </li>
            @endif

            {{-- contact --}}
            @if(Auth::user()->can('contact.all'))
            @php
            $contactCount = App\Models\Contact::where('status','unread')->count();
            @endphp
            <li class="nav-item @if(Route::currentRouteName() === 'all.contact' ) active @endif">
                <a href="{{ route('all.contact') }}" class="nav-link @if(Route::currentRouteName() === 'all.contact' ) active @endif">
                    <i class="link-icon" data-feather="phone-call"></i>
                    <span class="link-title">Contact</span>
                </a>
                @if($contactCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $contactCount }}
                    </span>
                @endif
            </li>
            @endif

            {{-- Testimonials Manage --}}
            @if(Auth::user()->can('testimonials.menu'))
            <li class="nav-item @if(Route::currentRouteName() === 'all.testimonials' || Route::currentRouteName() === 'add.testimonials' ) active @endif">
                <a class="nav-link" data-bs-toggle="collapse" href="#testimonials" role="button" aria-expanded="false"
                    aria-controls="testimonials">
                    <i class="link-icon" data-feather="pen-tool"></i>
                    <span class="link-title">Manage Testimonials </span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse @if(Route::currentRouteName() === 'all.testimonials' || Route::currentRouteName() === 'add.testimonials' ) show @endif" id="testimonials">
                    <ul class="nav sub-menu">
                        @if(Auth::user()->can('testimonials.all'))
                        <li class="nav-item @if(Route::currentRouteName() === 'all.testimonials' ) active @endif">
                            <a href="{{ route('all.testimonials') }}" class="nav-link @if(Route::currentRouteName() === 'all.testimonials' ) active @endif">All Testimonials</a>
                        </li>
                        @endif
                        @if(Auth::user()->can('testimonials.add'))
                        <li class="nav-item @if(Route::currentRouteName() === 'add.testimonials' ) active @endif">
                            <a href="{{ route('add.testimonials') }}" class="nav-link @if(Route::currentRouteName() === 'add.testimonials' ) active @endif">Add Testimonials</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif

            {{-- manage agent --}}
            @if(Auth::user()->can('register.agent'))
            <li class="nav-item @if(Route::currentRouteName() === 'register.agent' ) active @endif">
                <a href="{{ route('register.agent') }}" class="nav-link @if(Route::currentRouteName() === 'register.agent' ) active @endif">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Register Agent</span>
                </a>
            </li>
            @endif

            {{-- manage user --}}
            @if(Auth::user()->can('register.user'))
            <li class="nav-item  @if(Route::currentRouteName() === 'register.user' ) active @endif">
                <a href="{{ route('register.user') }}" class="nav-link  @if(Route::currentRouteName() === 'register.user' ) active @endif">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Register User</span>
                </a>
            </li>
            @endif

            {{-- Blog Post --}}
            @if(Auth::user()->can('blog.menu'))
            <li class="nav-item  @if(Route::currentRouteName() === 'add.post' || Route::currentRouteName() === 'all.post' || Route::currentRouteName() === 'all.blog.category' || Route::currentRouteName() === 'admin.blog.comment' ) active @endif">
                <a class="nav-link" data-bs-toggle="collapse" href="#Post" role="button" aria-expanded="false"
                    aria-controls="Post">
                    <i class="link-icon" data-feather="book-open"></i>
                    <span class="link-title">Blog Post </span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse  @if(Route::currentRouteName() === 'add.post' || Route::currentRouteName() === 'all.post' || Route::currentRouteName() === 'all.blog.category' || Route::currentRouteName() === 'admin.blog.comment' ) show @endif" id="Post">
                    <ul class="nav sub-menu">

                        @if(Auth::user()->can('blog.post.add'))
                        <li class="nav-item @if(Route::currentRouteName() === 'add.post' ) active @endif">
                            <a href="{{ route('add.post') }}" class="nav-link @if(Route::currentRouteName() === 'add.post' ) active @endif">Add Post </a>
                        </li>
                        @endif

                        @if(Auth::user()->can('blog.post.all'))
                        <li class="nav-item @if(Route::currentRouteName() === 'all.post' ) active @endif">
                            <a href="{{ route('all.post') }}" class="nav-link @if(Route::currentRouteName() === 'all.post' ) active @endif">All Post </a>
                        </li>
                        @endif

                        @if(Auth::user()->can('blog.category.all'))
                        <li class="nav-item @if(Route::currentRouteName() === 'all.blog.category' ) active @endif">
                            <a href="{{ route('all.blog.category') }}" class="nav-link @if(Route::currentRouteName() === 'all.blog.category' ) active @endif">Blog Category </a>
                        </li>
                        @endif

                        @php
                            $comment = App\Models\Comment::Where('parent_id',null)->where('status','unreply')->get();
                        @endphp

                        @if(Auth::user()->can('blog.comment.all'))
                        <li class="nav-item @if(Route::currentRouteName() === 'admin.blog.comment' ) active @endif">
                            <a href="{{ route('admin.blog.comment') }}" class="nav-link @if(Route::currentRouteName() === 'admin.blog.comment' ) active @endif">Blog Comment </a>
                            @if(count($comment) > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ count($comment) }}
                                </span>
                            @endif
                        </li>
                        @endif

                    </ul>
                </div>
            </li>
            @endif

            {{-- Role & Permission --}}
            @if(Auth::user()->can('role.permission.menu'))
            <li class="nav-item @if(Route::currentRouteName() === 'all.permission' || Route::currentRouteName() === 'add.permission' || Route::currentRouteName() === 'all.roles' || Route::currentRouteName() === 'add.roles' || Route::currentRouteName() === 'all.roles.permission' || Route::currentRouteName() === 'add.roles.permission' ) active @endif">
                <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button" aria-expanded="false"
                    aria-controls="advancedUI">
                    <i class="link-icon" data-feather="key"></i>
                    <span class="link-title">Role & Permission</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse  @if(Route::currentRouteName() === 'all.permission' || Route::currentRouteName() === 'add.permission' || Route::currentRouteName() === 'all.roles' || Route::currentRouteName() === 'add.roles' || Route::currentRouteName() === 'all.roles.permission' || Route::currentRouteName() === 'add.roles.permission' ) show @endif" id="advancedUI">
                    <ul class="nav sub-menu">
                        @if(Auth::user()->can('permission.add'))
                        <li class="nav-item  @if(Route::currentRouteName() === 'all.permission') active @endif">
                            <a href="{{ route('all.permission') }}" class="nav-link  @if(Route::currentRouteName() === 'all.permission') active @endif">All Permission</a>
                        </li>
                        @endif
                        @if(Auth::user()->can('permission.add'))
                        <li class="nav-item  @if(Route::currentRouteName() === 'add.permission') active @endif">
                            <a href="{{ route('add.permission') }}" class="nav-link  @if(Route::currentRouteName() === 'add.permission') active @endif"> Add Permission </a>
                        </li>
                        @endif
                        @if(Auth::user()->can('role.all'))
                        <li class="nav-item  @if(Route::currentRouteName() === 'all.roles' ) active @endif">
                            <a href="{{ route('all.roles') }}" class="nav-link  @if(Route::currentRouteName() === 'all.roles' ) active @endif">All Roles </a>
                        </li>
                        @endif
                        @if(Auth::user()->can('role.add'))
                        <li class="nav-item @if(Route::currentRouteName() === 'add.roles' ) active @endif">
                            <a href="{{ route('add.roles') }}" class="nav-link @if(Route::currentRouteName() === 'add.roles' ) active @endif">Add Roles </a>
                        </li>
                        @endif
                        @if(Auth::user()->can('role.permission.all'))
                        <li class="nav-item @if(Route::currentRouteName() === 'all.roles.permission' ) active @endif">
                            <a href="{{ route('all.roles.permission') }}" class="nav-link @if(Route::currentRouteName() === 'all.roles.permission' ) active @endif">All Role in Permission </a>
                        </li>
                        @endif
                        @if(Auth::user()->can('role.permission.add'))
                        <li class="nav-item @if(Route::currentRouteName() === 'add.roles.permission' ) active @endif">
                            <a href="{{ route('add.roles.permission') }}" class="nav-link @if(Route::currentRouteName() === 'add.roles.permission' ) active @endif">Role in Permission </a>
                        </li>
                        @endif

                    </ul>
                </div>
            </li>
            @endif

            {{-- admin user --}}
            @if(Auth::user()->can('admin.user.menu'))
            <li class="nav-item @if(Route::currentRouteName() === 'all.admin' || Route::currentRouteName() === 'add.admin' ) active @endif">
                <a class="nav-link" data-bs-toggle="collapse" href="#Admin" role="button" aria-expanded="false"
                    aria-controls="Admin">
                    <i class="link-icon" data-feather="user"></i>
                    <span class="link-title">Manage Admin User</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse @if(Route::currentRouteName() === 'all.admin' || Route::currentRouteName() === 'add.admin' ) show @endif" id="Admin">
                    <ul class="nav sub-menu">
                        @if(Auth::user()->can('admin.user.all'))
                        <li class="nav-item @if(Route::currentRouteName() === 'all.admin') active @endif">
                            <a href="{{ route('all.admin') }}" class="nav-link @if(Route::currentRouteName() === 'all.admin') active @endif">All Admin</a>
                        </li>
                        @endif
                        @if(Auth::user()->can('admin.user.add'))
                        <li class="nav-item @if(Route::currentRouteName() === 'add.admin') active @endif">
                            <a href="{{ route('add.admin') }}" class="nav-link @if(Route::currentRouteName() === 'add.admin') active @endif">Add Admin </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif

            {{-- Setting --}}
            @if(Auth::user()->can('setting.menu'))
            <li class="nav-item @if(Route::currentRouteName() === 'banner' || Route::currentRouteName() === 'package.setting' || Route::currentRouteName() === 'smtp.setting' || Route::currentRouteName() === 'site.setting' || Route::currentRouteName() === 'site.term_service'|| Route::currentRouteName() === 'site.privacy_policy') active @endif">
                <a class="nav-link" data-bs-toggle="collapse" href="#setting" role="button" aria-expanded="false"
                    aria-controls="setting">
                    <i class="link-icon" data-feather="settings"></i>
                    <span class="link-title">Setting</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse  @if(Route::currentRouteName() === 'banner' || Route::currentRouteName() === 'package.setting' || Route::currentRouteName() === 'smtp.setting' || Route::currentRouteName() === 'site.setting' || Route::currentRouteName() === 'site.term_service'|| Route::currentRouteName() === 'site.privacy_policy') show @endif" id="setting">
                    <ul class="nav sub-menu">
                        @if(Auth::user()->can('setting.banner'))
                        <li class="nav-item @if(Route::currentRouteName() === 'banner') active @endif">
                            <a href="{{ route('banner') }}" class="nav-link @if(Route::currentRouteName() === 'banner') active @endif">Banner</a>
                        </li>
                        @endif
                        @if(Auth::user()->can('setting.package'))
                        <li class="nav-item @if(Route::currentRouteName() === 'package.setting') active @endif">
                            <a href="{{ route('package.setting') }}" class="nav-link @if(Route::currentRouteName() === 'package.setting') active @endif">Package Setting</a>
                        </li>
                        @endif
                        @if(Auth::user()->can('setting.smtp'))
                        <li class="nav-item  @if(Route::currentRouteName() === 'smtp.setting') active @endif">
                            <a href="{{ route('smtp.setting') }}" class="nav-link  @if(Route::currentRouteName() === 'smtp.setting') active @endif">Smtp Setting</a>
                        </li>
                        @endif
                        @if(Auth::user()->can('setting.site'))
                        <li class="nav-item @if(Route::currentRouteName() === 'site.setting') active @endif">
                            <a href="{{ route('site.setting') }}" class="nav-link @if(Route::currentRouteName() === 'site.setting') active @endif">Site Setting</a>
                        </li>
                        @endif
                        @if(Auth::user()->can('setting.term_service'))
                        <li class="nav-item @if(Route::currentRouteName() === 'site.term_service') active @endif">
                            <a href="{{ route('site.term_service') }}" class="nav-link @if(Route::currentRouteName() === 'site.term_service') active @endif">Terms of Service</a>
                        </li>
                        @endif
                        @if(Auth::user()->can('setting.privacy_policy'))
                        <li class="nav-item  @if(Route::currentRouteName() === 'site.privacy_policy') active @endif">
                            <a href="{{ route('site.privacy_policy') }}" class="nav-link  @if(Route::currentRouteName() === 'site.privacy_policy') active @endif">Privacy Policy</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif
        </ul>
    </div>
</nav>

