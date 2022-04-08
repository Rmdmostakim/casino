<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Main Site</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="{{url('/user')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>
<!-- Divider -->
<hr class="sidebar-divider my-0">
<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="{{url('user/depositsummary')}}"><i class="fas fa-fw fa-table"></i><span>Deposit Summary</span></a>
</li>
<hr class="sidebar-divider my-0">
<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="{{url('user/withdraw')}}"><i class="fas fa-university" aria-hidden="true"></i><span>Withdraw</span></a>
</li>
<hr class="sidebar-divider my-0">
<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="{{url('user/withdrawsummary')}}"><i class="fas fa-credit-card" aria-hidden="true"></i><span>Withdraw Summary</span></a>
</li>
<hr class="sidebar-divider my-0">
<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="{{url('user/gamesummary')}}"><i class="fas fa-trophy" aria-hidden="true"></i><span>Game Summary</span></a>
</li>
</ul>
<!-- End of Sidebar -->