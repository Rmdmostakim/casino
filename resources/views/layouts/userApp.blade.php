<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <!-- Google Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
        <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
        <link href="{{asset('css/app.css')}}" rel="stylesheet" >
        <link href="{{asset('css/userapp.css')}}" rel="stylesheet" >
        <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    </head>

    <body id="page-top">
        <div id="wrapper">
            @include('layouts.userAppSidebar')
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    @include('layouts.userMenu')
                    <div class="container-fluid">
                        @include('layouts.userAppSummary')
                        @yield('content')
                    </div>    
                </div>
            </div>
        </div>
        <!-- javascript -->
        <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/datatables.js')}}"></script>
        @yield('script')
    </body>
</html>