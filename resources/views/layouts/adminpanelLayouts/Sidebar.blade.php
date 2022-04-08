<div class="col-lg-3">
    <div class="dashboard-sidebar">
        <div class="close-dashboard d-lg-none">
            <i class="las la-times"></i>
        </div>
        <div class="dashboard-user">
            <div class="user-thumb">
                <img src="{{ asset(\AdminAuth::avatar()) }}" alt="avatar.png">
            </div>
            <div class="user-content">
                <span class="fs-sm">Welcome</span>
                <h5 class="name">{{ \AdminAuth::adminInfo()->admin_name}}</h5>
                <ul class="user-option">
                    <li>
                        <a href="#0">
                            <i class="las la-bell"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.profile') }}">
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
                <a href="{{ route('admin.dashboard') }}" class="{{ \Request::is('admin/dashboard') ? 'active' : '' }}">Dashboard</a>
            </li>
            @if(\Request::session()->has('admin_type') && \Request::session()->get('admin_type') == 'admin')
            <li>
                <a href="{{ route('admin.addnew') }}" class="{{ \Request::is('admin/addnew-admin') ? 'active' : '' }}">Add Admin</a>
            </li>
            @endif
            @if(\Request::session()->has('admin_type') && \Request::session()->get('admin_type') == 'admin')
            <li>
                <a href="{{ route('admin.adminlist') }}" class="{{ \Request::is('admin/adminlist') ? 'active' : '' }}">Admin List</a>
            </li>
            @endif
            <li>
                <a href="{{ route('admin.depositrequest') }}" class="{{ \Request::is('admin/deposit-request') ? 'active' : '' }}">Deposit</a>
            </li>
            <li>
                <a href="{{ route('admin.withdrawrequest') }}" class="{{ \Request::is('admin/withdraw-request') ? 'active' : '' }}">Withdraw</a>
            </li>
            <li>
                <a href="{{ route('admin.transection') }}" class="{{ \Request::is('admin/transection') ? 'active' : '' }}">Transection History</a>
            </li>
            @if(\Request::session()->has('admin_type') && \Request::session()->get('admin_type') == 'admin')
            <li>
                <a href="{{ route('admin.gamesetting') }}" class="{{ \Request::is('admin/gamesetting') ? 'active' : '' }}">Game Setting</a>
            </li>
            @endif
            <li>
                <a href="{{ route('admin.profile') }}" class="{{ \Request::is('admin/admin-profile') ? 'active' : '' }}">Account Settings</a>
            </li>
            <li>
                <a href="{{ route('admin.changepassword') }}" class="{{ \Request::is('admin/change-password') ? 'active' : '' }}">Security Settings</a>
            </li>
            <li>
                <a href="{{ route('admin.clear') }}">Cache Clear</a>
            </li>
			<li>
                <a href="{{ route('admin.optimize') }}">System Optimizer</a>
            </li>
            <li>
                <a href="{{ route('logout') }}">Sign Out</a>
            </li>
        </ul>
    </div>
</div>
