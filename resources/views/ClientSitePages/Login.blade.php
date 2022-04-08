@extends('layouts.ClientSiteLayouts.ClientSiteApp')
@section('title','Login')
@section('content')
    <!-- inner hero section start -->
    <section class="inner-banner bg_img" style="background: url({{asset('images/inner-banner/bg2.jpg')}}) top;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-xl-6 text-center">
                    <h2 class="title text-white">Sign In</h2>
                    <ul class="breadcrumbs d-flex flex-wrap align-items-center justify-content-center">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li>Sign In</li>
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
                <div class="account__form__wrapper">
                    <div class="logo"><a href="{{url('/')}}"><img src="{{asset('images/logo.png')}}" alt="logo"></a></div>
                    @if (session('error'))
                    <div class="alert badge--danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="alert badge--success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form class="account__form form row g-4" method="post" action="{{ route('user.login') }}">
                        @csrf
                        @method('post')
                        <div class="col-12" id="username-handler">
                            <div class="form-group">
                                <div for="username" class="input-pre-icon"><i class="las la-user"></i></div>
                                <input id="username" type="text" name="username"
                                 @if(\Cookie::has('username'))
                                 value="{{ \Cookie::get('username') }}"
                                 @else
                                 value="{{ old('username') }}"
                                 @endif
                                 class="form--control form-control style--two" placeholder="Username" required>
                            </div>
                            @error('username')
                            <div class="input-error">
                                <span class="error-text">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="col-12" id="password-handler">
                            <div class="form-group">
                                <div for="pasword" class="input-pre-icon"><i class="las la-lock"></i></div>
                                <input id="password" type="password" name="password"
                                @if(\Cookie::has('password'))
                                 value="{{ \Cookie::get('password') }}"
                                 @else
                                 value="{{ old('password') }}"
                                 @endif
                                 class="form--control form-control style--two" placeholder="Password" required>
                            </div>
                            @error('password')
                            <div class="input-error">
                                <span class="error-text">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button class="cmn--btn active w-100 btn--round" type="submit">Sign In</button>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between mt-5">
                            <div class="form--check d-flex align-items-center">
                                @if(\Cookie::has('username'))
                                <input id="check" name="remember" type="checkbox" checked>
                                <label for="check">Remember me</label>
                                 @else
                                <input id="check" name="remember" type="checkbox">
                                <label for="check">Remember me</label>
                                @endif
                            </div>
                            <a href="{{ route('user.reserpassword') }}" class="forgot-pass d-block text--base">Forgot Password ?</a>
                        </div>
                    </form>
                </div>
                <div class="account__content__wrapper" >
                    <div class="content text-center text-white">
                        <h3 class="title text--base mb-4">Welcome to Casinio</h3>
                        <p class="">Sign in your Account. Atque, fuga sapiente, doloribus qui enim tempora?</p>
                        <p class="account-switch mt-4">Don't have an Account yet ? <a class="text--base ms-2" href="{{url('/registration')}}">Sign Up</a></p>
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
        $("#username-handler").click(function(){
            $(this).children('.input-error').empty();
        });
        $("#password-handler").click(function(){
            $(this).children('.input-error').empty();
        });
    });
</script>
@endsection