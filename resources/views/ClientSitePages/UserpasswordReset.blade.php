@extends('layouts.ClientSiteLayouts.ClientSiteApp')
@section('title','Forgot Password')
@section('content')
    <!-- inner hero section start -->
    <section class="inner-banner bg_img" style="background: url({{asset('images/inner-banner/bg2.jpg')}}) top;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-xl-6 text-center">
                    <h2 class="title text-white">Sign In</h2>
                    <ul class="breadcrumbs d-flex flex-wrap align-items-center justify-content-center">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li>Forget Password</li>
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
                    <form class="account__form form row g-4" method="post" action="{{route('user.confirmreset')}}">
                        @csrf
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
                                <input id="password" type="password" name="password" value="{{ old('password') }}" class="form--control form-control style--two" placeholder="New Password" required>
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
                                <button class="cmn--btn active w-100 btn--round" type="submit">Reset Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Account Section Ends Here -->
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $("#email-handler").click(function(){
            $(this).children('.input-error').empty();
        });
        $("#password-handler").click(function(){
            $(this).children('.input-error').empty();
        });
    });
</script>
@endsection
