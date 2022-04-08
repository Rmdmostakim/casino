@extends('layouts.ClientSiteLayouts.ClientSiteApp')
@section('title','Registration')
@section('content')
    <!-- inner hero section start -->
    <section class="inner-banner bg_img" style="background: url({{asset('images/inner-banner/bg2.jpg')}}) top;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-xl-6 text-center">
                    <h2 class="title text-white">Sign In</h2>
                    <ul class="breadcrumbs d-flex flex-wrap align-items-center justify-content-center">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li>Sign Up</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- inner hero section end -->
    <!-- Account Section Starts Here -->
    <section class="account-section overflow-hidden bg_img" style="background:url({{asset('images/account/bg.jpg')}})">
        <div class="container">
            <div class="account__main__wrapper">
                <div class="account__form__wrapper sign-up">
                    <div class="logo"><a href="{{url('/')}}"><img src="{{asset('images/logo.png')}}" alt="logo"></a></div>
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <form class="account__form form row g-4" method="post" action="{{route('user.reg')}}">
                        @csrf
                        @method('post')
                        <div class="col-xl-6 col-md-6" id="fname-handler">
                            <div class="form-group">
                                <div for="fname" class="input-pre-icon"><i class="las la-user"></i></div>
                                <input id="fname" type="text" name="fname" value="{{ old('fname') }}" class="form--control form-control style--two" placeholder="Full Name" required>
                            </div>
                            @error('fname')
                                <div class="input-error">
                                    <span class="error-text">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-xl-6 col-md-6" id="username-handler">
                            <div class="form-group">
                                <div for="username" class="input-pre-icon"><i class="las la-user"></i></div>
                                <input id="username" type="text" name="username" value="{{ old('username') }}" class="form--control form-control style--two" placeholder="Username" required>
                            </div>
                            @error('username')
                            <div class="input-error">
                                <span class="error-text">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="col-xl-6 col-md-6" id="phone-handler">
                            <div class="form-group">
                                <div for="phone" class="input-pre-icon"><i class="las la-phone"></i></div>
                                <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" class="form--control form-control style--two" placeholder="Phone" required>
                            </div>
                            @error('phone')
                            <div class="input-error">
                                <span class="error-text">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="col-xl-6 col-md-6" id="email-handler">
                            <div class="form-group">
                                <div for="email" class="input-pre-icon"><i class="las la-envelope"></i></div>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" class="form--control form-control style--two" placeholder="Email" required>
                            </div>
                            @error('email')
                            <div class="input-error">
                                <span class="error-text">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>

                        <div class="col-xl-6 col-md-6" id="password-handler">
                            <div class="form-group">
                                <div for="password" class="input-pre-icon"><i class="las la-lock"></i></div>
                                <input id="password" type="password" name="password" value="{{ old('password') }}" class="form--control form-control style--two" placeholder="Password" required>
                            </div>
                            @error('password')
                            <div class="input-error">
                                <span class="error-text">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="form-group">
                                <div for="password_confirm" class="input-pre-icon"><i class="las la-lock"></i></div>
                                <input id="password_confirm" type="password" name="password_confirmation" class="form--control form-control style--two" placeholder="Confirm Password" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <button class="cmn--btn active w-100 btn--round" type="submit">Sign Up</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="account__content__wrapper" >
                    <div class="content text-center text-white">
                        <h3 class="title text--base mb-4">Welcome to Casinio</h3>
                        <p class="">Sign in your Account. Get <span class="text--base">{{ \Gameplay::getactiveEvent()}}<i class='la la-bitcoin'></i></span> free</p>
                        <p class="account-switch mt-4">Already have an Account ? <a class="text--base ms-2" href="{{url('/login')}}">Sign In</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Account Section Ends Here -->
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $("#fname-handler").click(function(){
            $(this).children('.input-error').empty();
        });
        $("#username-handler").click(function(){
            $(this).children('.input-error').empty();
        });
        $("#phone-handler").click(function(){
            $(this).children('.input-error').empty();
        });
        $("#email-handler").click(function(){
            $(this).children('.input-error').empty();
        });
        $("#password-handler").click(function(){
            $(this).children('.input-error').empty();
        });
    });
</script>
@endsection
