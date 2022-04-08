<div class="col-lg-3">
    <div class="dashboard-sidebar">
        <div class="close-dashboard d-lg-none">
            <i class="las la-times"></i>
        </div>
        <div class="dashboard-user">
            <div class="user-thumb">
                <img src="{{ asset(\UserAuth::avatar()) }}" alt="avatar.png">
            </div>
            <div class="user-content">
                <span class="fs-sm">Welcome</span>
                <h5 class="name">{{ \UserAuth::userInfo()->username}}</h5>
                <ul class="user-option">
                    <li>
                        <a href="#0">
                            <i class="las la-bell"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.profile') }}">
                            <i class="las la-pen"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#0">
                            <i class="las la-envelope"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <ul class="user-dashboard-tab">
            <li>
                <a href="{{ route('user.dashboard') }}" class="{{ \Request::is('user/dashboard') ? 'active' : '' }}">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('deposit') }}" class="{{ \Request::is('user/deposit') ? 'active' : '' }}">Deposit</a>
            </li>
            <li>
                <a href="{{ route('withdraw') }}" class="{{ \Request::is('user/withdraw') ? 'active' : '' }}">Withdraw</a>
            </li>
            <li>
                <a href="{{ route('transection') }}" class="{{ \Request::is('user/transection') ? 'active' : '' }}">Transection History</a>
            </li>
            <li>
                <a href="{{ route('user.profile') }}" class="{{ \Request::is('user/user-profile') ? 'active' : '' }}">Account Settings</a>
            </li>
            <li>
                <a href="{{ route('change.password') }}" class="{{ \Request::is('user/change-password') ? 'active' : '' }}">Security Settings</a>
            </li>
            <li>
                <a href="{{ route('logout') }}">Sign Out</a>
            </li>
        </ul>
    </div>
</div>
