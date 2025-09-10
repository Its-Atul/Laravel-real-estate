<style>
    .custom-active {
        background-color: #1baf65;
        border-radius: 10px;
    }

    .custom-active a {
        color: #fff !important; /* Set text color to white */
    }
</style>

@php
    $id = Auth::user()->id;
    $userData = App\Models\User::find($id);
@endphp

<div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
    <div class="blog-sidebar">
        <div class="sidebar-widget post-widget">
            <div class="widget-title">
                <h4>User Profile </h4>
            </div>
            <div class="post-inner">
                <div class="post">
                    <figure class="post-thumb"><a href="javascript:void(0)">
                     <img src="{{ (!empty($userData->photo)) ? url('upload/user_images/'.$userData->photo) : url('upload/no_image.jpg') }}" alt=""></a>
                    </figure>
                    <h5><a href="javascript:void(0)">{{ $userData->name }} </a></h5>
                    <p>{{ $userData->email }} </p>
                </div>
            </div>
        </div>
        <div class="sidebar-widget category-widget">
            <div class="widget-title">
            </div>
            <div class="widget-content">
                <ul class="category-list">
                    <li class="{{ request()->routeIs('dashboard') ? 'custom-active' : '' }}"><a href="{{ route('dashboard') }}" class="active"><i class="fa fa-tachometer"></i> Dashboard </a>
                    </li>
                    <li class="{{ request()->routeIs('user.schedule.request') ? 'custom-active' : '' }}"><a href="{{ route('user.schedule.request') }}"><i class="fa fa-calendar" aria-hidden="true"></i> Tour Schedule</a>
                    </li>
                    <li class="{{ request()->routeIs('user.compare') ? 'custom-active' : '' }}"><a href="{{ route('user.compare') }}"><i class="fa fa-list-alt" aria-hidden="true"></i></i> Compare </a>
                    </li>
                    <li class="{{ request()->routeIs('user.wishlist') ? 'custom-active' : '' }}"><a href="{{ route('user.wishlist') }}"><i class="fa fa-heart" aria-hidden="true"></i> WishList </a></li>
                    <li class="{{ request()->routeIs('user.change.password') ? 'custom-active' : '' }}"><a href="{{ route('user.change.password') }}"><i class="fa fa-key" aria-hidden="true"></i> Security </a>
                    </li>
                    <li class="{{ request()->routeIs('user.profile') ? 'custom-active' : '' }}"><a href="{{ route('user.profile') }}"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a>
                    </li>
                    <li class="{{ request()->routeIs('user.logout') ? 'custom-active' : '' }}"><a href="{{ route('user.logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
