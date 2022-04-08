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
        <link href="{{asset('css/mainSite.css')}}" rel="stylesheet" >
    </head>

    <body class="fix-header fix-sidebar">

        @include('layouts.siteMenu')

        @yield('content')

        @include('layouts.siteFooter')
        <!-- javascript -->
        <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
        @yield('script')
    </body>
</html>