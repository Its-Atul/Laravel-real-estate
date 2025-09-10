@php
    $id = Auth::user()->id;
    $agentId = App\Models\User::find($id);
    $cname = App\Models\SiteSetting::find('1');
    $schedule = App\Models\Schedule::where('status','0')->where('agent_id',$id)->count();
    $propertymessage = App\Models\PropertyMessage::where('agent_status','unread')->where('agent_id',$id)->count();
@endphp

<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('agent.dashboard') }}" class="sidebar-brand">
            {{ $cname->company_name ?? '' }}
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
            <li class="nav-item @if(Route::currentRouteName() === 'agent.dashboard' ) active @endif">
                <a href="{{ route('agent.dashboard') }}" class="nav-link @if(Route::currentRouteName() === 'agent.dashboard' ) active @endif">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">RealEstate</li>
            <li class="nav-item @if(Route::currentRouteName() === 'agent.all.property' ) active @endif">
                <a class="nav-link" data-bs-toggle="collapse" href="#property" role="button" aria-expanded="false"
                    aria-controls="emails">
                    <i class="link-icon" data-feather="home"></i>
                    <span class="link-title">Property </span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse @if(Route::currentRouteName() === 'agent.all.property' ) show @endif" id="property">
                    <ul class="nav sub-menu">
                        <li class="nav-item @if(Route::currentRouteName() === 'agent.all.property' ) active @endif">
                            <a href="{{ route('agent.all.property') }}" class="nav-link @if(Route::currentRouteName() === 'agent.all.property' ) active @endif">All Property</a>
                        </li>
                        <li class="nav-item @if(Route::currentRouteName() === 'agent.add.property' ) active @endif">
                            <a href="{{ route('agent.add.property') }}" class="nav-link @if(Route::currentRouteName() === 'agent.add.property' ) active @endif">Add Property</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item @if(Route::currentRouteName() === 'buy.package' ) active @endif">
                <a href="{{ route('buy.package') }}" class="nav-link @if(Route::currentRouteName() === 'buy.package' ) active @endif">
                    <i class="link-icon" data-feather="shopping-bag"></i>
                    <span class="link-title">Buy Package</span>
                </a>
            </li>
            <li class="nav-item @if(Route::currentRouteName() === 'package.history' ) active @endif">
                <a href="{{ route('package.history') }}" class="nav-link @if(Route::currentRouteName() === 'package.history' ) active @endif">
                <i class="link-icon" data-feather="clock"></i>
                <span class="link-title">Package History </span>
                </a>
            </li>
            <li class="nav-item @if(Route::currentRouteName() === 'agent.property.message' ) active @endif">
                <a href="{{ route('agent.property.message') }}" class="nav-link @if(Route::currentRouteName() === 'agent.property.message' ) active @endif">
                <i class="link-icon" data-feather="mail"></i>
                <span class="link-title">Property Message </span>
                </a>
                @if($propertymessage > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $propertymessage }}
                    </span>
                @endif
            </li>
            <li class="nav-item @if(Route::currentRouteName() === 'agent.schedule.request' ) active @endif">
                <a href="{{ route('agent.schedule.request') }}" class="nav-link @if(Route::currentRouteName() === 'agent.schedule.request' ) active @endif">
                <i class="link-icon" data-feather="calendar"></i>
                <span class="link-title">Tour Schedule </span>
                </a>
                @if($schedule > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $schedule }}
                    </span>
                @endif
            </li>
        </ul>
    </div>
</nav>
