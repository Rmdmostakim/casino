@extends('layouts.adminpanelLayouts.adminpanelApp')
@section('title','Profile')
@section('content')
<div class="col-lg-9">
    <!-- Profile Section Starts Here -->
    <section class="profile-section padding-bottom">
        <form action="{{ route('admin.profileupdate') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="profile-edit-wrapper">
                <div class="row gy-5">
                    <div class="col-xl-4">
                        <div class="profile__thumb__edit text-center custom--card">
                            <div class="card--body" id="avatar-handler">
                                <div class="thumb">
                                    <img src="{{ asset(\AdminAuth::avatar()) }}" alt="{{ \AdminAuth::adminInfo()->admin_name }}">
                                </div>
                                <div class="profile__info">
                                    <h4 class="name">{{ \AdminAuth::adminInfo()->admin_name }}</h4>
                                    <input type="file" class="form-control d-none" name="avatar" id="update-photo">
                                    <label class="cmn--btn active btn--md mt-3" for="update-photo">Update Profile Picture</label>
                                </div>
                                @error('avatar')
                                <div class="badge--danger rounded avatar-error">
                                    <small>{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="custom--card card--lg">
                            <div class="card--body">
                                <div class="row gy-3">
                                    @if (session('success'))
                                        <div class="alert text-center badge--success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if (session('error'))
                                        <div class="alert text-center badge--danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    <div class="col-md-6">
                                        <div class="form-group" id="fname-handler">
                                            <label for="name" class="form-label">Full Name</label>
                                            <input id="name" type="text" name="admin_name" 
                                            value="{{ \AdminAuth::adminInfo()->admin_name }}"
                                            class="form-control form--control style-two " placeholder="Full Name">
                                        </div>
                                        @error('admin_name')
                                        <div class="input-error">
                                            <span class="error-text">{{ $message }}</span>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6" id="phone-handler">
                                        <div class="form-group">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input id="phone" type="tel" name="admin_phone" value="{{ \AdminAuth::adminInfo()->admin_phone }}" class="form-control form--control style-two " placeholder="Phone Number">
                                        </div>
                                        @error('admin_phone')
                                        <div class="input-error">
                                            <span class="error-text">{{ $message }}</span>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6" id="email-handler">
                                        <div class="form-group">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input id="email" type="email" value="{{ \AdminAuth::adminInfo()->admin_email }}" class="form-control form--control style-two " readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="email-handler">
                                        <div class="form-group">
                                            <label for="email" class="form-label">Admin Role</label>
                                            <input id="email" type="text" value="{{ ucwords(\AdminAuth::adminInfo()->admin_type) }}" class="form-control form--control style-two " readonly>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="cmn--btn active mt-3 w-100">Update Profile</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>    
    </section>
    <!-- Profile Section Ends Here -->
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("#avatar-handler").click(function(){
                $(this).children('.avatar-error').empty();
            });
            $("#fname-handler").click(function(){
                $(this).children('.input-error').empty();
            });
            $("#username-handler").click(function(){
                $(this).children('.input-error').empty();
            });
            $("#phone-handler").click(function(){
                $(this).children('.input-error').empty();
            });
        });
    </script>
@endsection