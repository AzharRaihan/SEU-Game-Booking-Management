
<div class="topbar">
    <!-- LOGO -->
    <div class="topbar-left">
        <a href="index.html" class="logo">
            <i class="zmdi zmdi-group-work icon-c-logo"></i>
            <span>{{ setting('site_title') }}</span>
        </a>
    </div>
    <nav class="navbar-custom">
        <ul class="list-inline float-right mb-0">
            </li>
            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user d-flex align-items-center" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                   <div class="mr-2">
                       <span>{{ Auth::user()->name }}</span>
                   </div>
                    <img src="{{ Auth::user()->profile_photo != null ? asset('users/profile-pic/'. Auth::user()->profile_photo) : asset('default-avater/default.png') }}" alt="{{ Auth::user()->name }}-Image" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="text-overflow"><small>{{ Auth::user()->name }}</small> </h5>
                    </div>
                    <!-- item-->
                    <a href="{{ route('admin.profile') }}" class="dropdown-item notify-item">
                        <i class="icon-user"></i> <span>Profile</span>
                    </a>
                    <!-- item-->
                    <a href="{{ route('admin.change.password') }}" class="dropdown-item notify-item">
                        <i class="icon-key"></i> <span>Change Password</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item border-top" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="icon-power"></i> <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>
</div>
