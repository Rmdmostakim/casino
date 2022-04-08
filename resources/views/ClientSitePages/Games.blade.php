@extends('layouts.ClientSiteLayouts.ClientSiteApp')
@section('title','Games')
@section('content')
    <!-- inner hero section start -->
    <section class="inner-banner bg_img" style="background: url({{asset('images/inner-banner/bg2.jpg')}}) top;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-xl-6 text-center">
                    <h2 class="title text-white">Games</h2>
                    <ul class="breadcrumbs d-flex flex-wrap align-items-center justify-content-center">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li>Games</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- inner hero section end -->
    @include('layouts.ClientSiteLayouts.GameSection')
@endsection
