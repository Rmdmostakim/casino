@extends('layouts.ClientSiteLayouts.ClientSiteApp')
@section('title','Home')
@section('content')
    <!-- Banner Section Starts Here -->
    <section class="banner-section bg_img overflow-hidden" style="background:url({{asset('images/banner/bg.png')}}) center">
        <div class="container">
            <div class="banner-wrapper d-flex flex-wrap align-items-center">
                <div class="banner-content">
                    <a href="{{ route('sign-up') }}" class="btn btn--scuccess active">Sign up and get <span class="text--white">{{ \Gameplay::getactiveEvent()}}<i class='la la-bitcoin'></i></span> free</a>
                    <h1 class="banner-content__title">Play <span class="text--base">Online Casino</span> & Win Money Unlimited</h1>
                    <p class="banner-content__subtitle">PLAY CASINO AND EARN CRYPTO IN ONLINE. THE ULTIMATE ONLINE CASINO PLATFORM.</p>
                    <div class="button-wrapper">
                        <a href="{{url('/games')}}" class="cmn--btn active btn--lg"><i class="las la-play"></i> Play Now</a>
                        <a href="{{url('/registration')}}" class="cmn--btn btn--lg">Sign Up</a>
                    </div>
                    <img src="{{asset('images/banner/card.png')}}" alt="" class="shape1">
                </div>
                <div class="banner-thumb">
                    <img src="{{asset('images/banner/thumb.png')}}" alt="banner">
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section Ends Here -->
    <!-- About Section Starts Here -->
    <section class="about-section padding-top padding-bottom overflow-hidden">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-content">
                        <div class="section-header">
                            <h2 class="section-header__title">About The Casino</h2>
                            <p>A casino is a facility for certain types of gambling. Casinos are often built near or combined with hotels, resorts, restaurants, retail shopping, cruise ships, and other tourist attractions. Some casinos are also known for hosting live entertainment, such as stand-up comedy, concerts, and sports.</p>
                        </div>
                        <a href="{{url('/about')}}" class="cmn--btn active">Know More</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="aobut-thumb section-thumb">
                        <img src="{{asset('images/about/thumb.png')}}" alt="about" class="ms-lg-5">
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
    <!-- How Section Starts Here -->
    <section class="how-section padding-top padding-bottom bg_img" style="background: url({{asset('images/how/bg2.jpg')}});">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-header text-center">
                        <h2 class="section-header__title">How to Play Game</h2>
                        <p>A casino is a facility for certain types of gambling. Casinos are often built combined with hotels, resorts.</p>
                    </div>
                </div>
            </div>
            <div class="row gy-4 justify-content-center">
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="how-item">
                        <div class="how-item__thumb">
                            <i class="las la-user-plus"></i>
                            <div class="badge badge--lg badge--round radius-50">01</div>
                        </div>
                        <div class="how-item__content">
                            <h4 class="title">Sign Up First & Login</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="how-item">
                        <div class="how-item__thumb">
                            <i class="las la-id-card"></i>
                            <div class="badge badge--lg badge--round radius-50">02</div>
                        </div>
                        <div class="how-item__content">
                            <h4 class="title">Complete you Profile</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="how-item">
                        <div class="how-item__thumb">
                            <i class="las la-dice"></i>
                            <div class="badge badge--lg badge--round radius-50">03</div>
                        </div>
                        <div class="how-item__content">
                            <h4 class="title">Choose a Game & Play</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- How Section Ends Here -->
    @include('layouts.ClientSiteLayouts.GameSection')
    @include('layouts.ClientSiteLayouts.FrequentlyAsked')
    @include('layouts.ClientSiteLayouts.TopWinner')
    @include('layouts.ClientSiteLayouts.ClientReview')
@endsection
