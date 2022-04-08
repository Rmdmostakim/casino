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
    <a class="nav-link" href="{{url('/admin')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>
<!-- Divider -->
<hr class="sidebar-divider my-0">
<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="{{url('admin/add-admin')}}"><i class="fas fa-user"></i><span>Add Admin</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{url('admin/transection-number')}}"><i class="fas fa-user"></i><span>Transection Number</span></a>
</li>
<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="{{url('admin/gamerate')}}"><i class="fas fa-gamepad"></i><span>Game Rate</span></a>
</li>
<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="{{url('admin/pendingrequest')}}"><i class="fas fa-envelope"></i><span>Pending Request</span></a>
</li>
<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="{{url('admin/depositrequest')}}"><i class="fas fa-fw fa-table"></i><span>Deposit Request</span></a>
</li>
<hr class="sidebar-divider my-0">
<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="{{url('admin/totaldeposit')}}"><i class="fas fa-university" aria-hidden="true"></i><span>Deposits Table</span></a>
</li>
<hr class="sidebar-divider my-0">
<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="{{url('admin/withdrawrequest')}}"><i class="fas fa-credit-card" aria-hidden="true"></i><span>Withdraw Request</span></a>
</li>
<hr class="sidebar-divider my-0">
<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="{{url('admin/totalwithdraw')}}"><i class="fas fa-address-book"></i><span>Withdraw Table</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{url('admin/gameplaylist')}}"><i class="fas fa-trophy" aria-hidden="true"></i><span>Game Results</span></a>
</li>
</ul>
<!-- End of Sidebar -->