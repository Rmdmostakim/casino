<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{asset('images/favicon.png')}}" sizes="16x16">
    <!-- bootstrap 5  -->
    <link rel="stylesheet" href="{{asset('css/lib/bootstrap.min.css')}}">
    <!-- Icon Link  -->
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/lib/animate.css')}}">

    <!-- Plugin Link -->
    <link rel="stylesheet" href="{{asset('css/lib/slick.css')}}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <!-- custom css -->
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
</head>
<body data-bs-spy="scroll" data-bs-offset="170" data-bs-target=".privacy-policy-sidebar-menu">
@include('layouts.ClientSiteLayouts.Loader')
@include('layouts.UserpanelLayouts.Navbar')
<div class="dashboard-section padding-top padding-bottom">
    <div class="container">
        <div class="row">
            @include('layouts.UserpanelLayouts.Sidebar')
            @yield('content')
        </div>
    </div>
</div>
<!-- jQuery library -->
<script src="{{asset('js/lib/jquery-3.6.0.min.js')}}"></script>
<!-- bootstrap 5 js -->
<script src="{{asset('js/lib/bootstrap.min.js')}}"></script>

<!-- Pluglin Link -->
<script src="{{asset('js/lib/slick.min.js')}}"></script>

<!-- main js -->
<script src="{{asset('js/main.js')}}"></script>
<!--data table plugins--->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<!---axios---->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@yield('script')
</body>
</html>