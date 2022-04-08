<div class="col-lg-3">
    <div class="dashboard-sidebar">
        <div class="close-dashboard d-lg-none">
            <i class="las la-times"></i>
        </div>
        <div class="dashboard-user">
            <div class="user-thumb">
                <img src="{{ asset('images/avatar.png') }}" alt="avatar.png">
            </div>
            <div class="user-content">
                <span class="fs-sm">Welcome</span>
                <h5 class="name">Super Admin</h5>
            </div>
        </div>
        <ul class="user-dashboard-tab">
            <li>
                <a href="{{ route('superadmin.dashboard') }}" class="{{ \Request::is('superadmin/dashboard') ? 'active' : '' }}">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('superadmin.clear') }}">Cache Clear</a>
            </li>
            <li>
                <a href="{{ route('logout') }}">Sign Out</a>
            </li>
        </ul>
    </div>
</div>
