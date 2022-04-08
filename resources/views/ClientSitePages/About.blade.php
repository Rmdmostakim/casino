@extends('layouts.ClientSiteLayouts.ClientSiteApp')
@section('title','About')
@section('content')
    <!-- inner hero section start -->
    <section class="inner-banner bg_img" style="background: url({{asset('images/inner-banner/bg2.jpg')}}) top;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-xl-6 text-center">
                    <h2 class="title text-white">About Page</h2>
                    <ul class="breadcrumbs d-flex flex-wrap align-items-center justify-content-center">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li>About</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- inner hero section end -->
    <!-- About Section Starts Here -->
    <section class="about-section padding-top padding-bottom overflow-hidden">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-content">
                        <div class="section-header mb-4">
                            <h2 class="section-header__title">About The Casino</h2>
                            <p>A casino is a facility for certain types of gambling. Casinos are often built near or combined with hotels, resorts, restaurants, retail shopping, cruise ships, and other tourist attractions.</p>
                        </div>
                        <p>Eaque laudantium quo voluptatibus fugit perferendis atque numquam vel porro eius, quidem deleniti, adipisci deserunt omnis sunt. Cum, sapiente rerum maiores fuga debitis dicta nemo molestiae temporibus accusamus natus placeat doloremque vel quo. Cumque, molestias facere. Aliquid sequi delectus voluptate voluptatem eius eaque, qui assumenda ad officia, dicta, sunt eos corrupti fuga ex cum exercitationem?</p>
                    </div>
                    <a href="{{url('/login')}}" class="cmn--btn active mt-sm-5 mt-4">Get Started</a>
                </div>
                <div class="col-lg-6">
                    <div class="aobut-thumb section-thumb">
                        <img src="{{asset('images/about/thumb2.png')}}" alt="about" class="ms-lg-5">
                    </div>
                </div>
            </div>
        </div>
        <div class="shapes">
            <img src="{{asset('images/about/shape.png')}}" alt="about" class="shape shape1">
        </div>
    </section>
    <!-- About Section Ends Here -->
    @include('layouts.ClientSiteLayouts.WhyPlay')
    @include('layouts.ClientSiteLayouts.FrequentlyAsked')
    @include('layouts.ClientSiteLayouts.ClientReview')
@endsection
