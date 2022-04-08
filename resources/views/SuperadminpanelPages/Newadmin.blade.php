@extends('layouts.superadminpanelLayouts.superadminpanelApp')
@section('content')
    <div class="col-lg-9">
        <!-- Add new admin from super admin pannel Section Starts Here -->
        <section class="account-section overflow-hidden bg_img" style="background:url({{asset('images/account/bg.jpg')}})">
            <div class="container">
                <div class="account__main__wrapper">
                    <div class="account__form__wrapper sign-up">
                        <div class="logo"><a href="{{url('/')}}"><img src="{{asset('images/logo.png')}}" alt="logo"></a></div>
                        @if (session('error'))
                            <div class="alert badge--danger text-center">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form class="account__form form row g-4" method="get" action="{{ route('superadmin.add-newadmin') }}">
                            <div class="col-xl-6 col-md-6" id="name-handler">
                                <div class="form-group">
                                    <div for="admin-name" class="input-pre-icon"><i class="las la-user"></i></div>
                                    <input id="admin-name" type="text" name="admin_name" value="{{ old('admin_name') }}" class="form--control form-control style--two" placeholder="Admin name" required>
                                </div>
                                @error('admin_name')
                                <div class="input-error">
                                    <span class="error-text">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-6 col-md-6" id="email-handler">
                                <div class="form-group">
                                    <div for="admin-email" class="input-pre-icon"><i class="las la-envelope"></i></div>
                                    <input id="admin-email" type="email" name="admin_email" value="{{ old('admin_email') }}" class="form--control form-control style--two" placeholder="Admin email" required>
                                </div>
                                @error('admin_email')
                                <div class="input-error">
                                    <span class="error-text">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-6 col-md-6" id="phone-handler">
                                <div class="form-group">
                                    <div for="admin-phone" class="input-pre-icon"><i class="las la-phone"></i></div>
                                    <input id="admin-phone" type="tel" name="admin_phone" value="{{ old('admin_phone') }}" class="form--control form-control style--two" placeholder="Admin phone" required>
                                </div>
                                @error('admin_phone')
                                <div class="input-error">
                                    <span class="error-text">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-6 col-md-6" id="type-handler">
                                <div class="form-group">
                                    <div for="admin-type" class="input-pre-icon"><i class="la la-exchange"></i></div>
                                    <select id="admin-type" name="admin_type" class="form-control form--control form-control style--two">
                                        <option selected>Admin Role..</option>
                                        <option value="admin">Admin</option>
                                        <option value="staff">Staff</option>
                                    </select>
                                </div>
                                @error('admin_type')
                                <div class="input-error">
                                    <span class="error-text">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-6 col-md-6" id="password-handler">
                                <div class="form-group">
                                    <div for="admin-password" class="input-pre-icon"><i class="las la-lock"></i></div>
                                    <input id="admin-password" type="password" name="password" value="{{ old('password') }}" class="form--control form-control style--two" placeholder="Admin password" required>
                                </div>
                                @error('password')
                                <div class="input-error">
                                    <span class="error-text">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-6 col-md-6" id="confirm-handler">
                                <div class="form-group">
                                    <div for="admin-password_confirm" class="input-pre-icon"><i class="las la-lock"></i></div>
                                    <input id="admin-password_confirm" type="password" name="password_confirm" class="form--control form-control style--two" placeholder="Confirm password" required>
                                </div>
                                @error('password_confirm')
                                <div class="input-error">
                                    <span class="error-text">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <button class="cmn--btn active w-100 btn--round" type="submit">Make Admin</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- add new admin from super admin Section Ends Here -->
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("#name-handler").click(function(){
                $(this).children('.input-error').empty();
            });
            $("#email-handler").click(function(){
                $(this).children('.input-error').empty();
            });
            $("#phone-handler").click(function(){
                $(this).children('.input-error').empty();
            });
            $("#type-handler").click(function(){
                $(this).children('.input-error').empty();
            });
            $("#password-handler").click(function(){
                $(this).children('.input-error').empty();
            });
            $("#confirm-handler").click(function(){
                $(this).children('.input-error').empty();
            });
        });
    </script>
@endsection