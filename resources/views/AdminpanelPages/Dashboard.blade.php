@extends('layouts.adminpanelLayouts.adminpanelApp')
@section('title','Admin Dashboard')
@section('content')
<!-- Dashboard Section Starts Here -->
<div class="col-lg-9">
    <div class="row justify-content-center g-4">
        <div class="col-lg-6 col-xl-4 col-md-6 col-sm-10">
            <div class="dashboard__card">
                <div class="dashboard__card-content">
                    <h2 class="price"><i class="la la-user"></i>{{ \AdminAuth::totalUser() }}</h2>
                    <p class="info">TOTAL USER</p>
                    <a href="{{ route('admin.userlist') }}" class="view-btn">View All</a>
                </div>
                <div class="dashboard__card-icon">
                    <i class="las la-user"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 col-md-6 col-sm-10">
            <div class="dashboard__card">
                <div class="dashboard__card-content">
                    <h2 class="price"><i class="la la-flag"></i>{{ \AdminAuth::totalCountry() }}</h2>
                    <p class="info">USERS COUNTRY</p>
                    <a href="{{ route('admin.userlist') }}" class="view-btn">View All</a>
                </div>
                <div class="dashboard__card-icon">
                    <i class="las la-flag"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 col-md-6 col-sm-10">
            <div class="dashboard__card">
                <div class="dashboard__card-content">
                    <h2 class="price"><i class="la la-bitcoin"></i>{{ \AdminAuth::totalDeposit() }}</h2>
                    <p class="info">TOTAL DEPOSIT</p>
                    <a href="{{ route('admin.totaldeposit') }}" class="view-btn">View All</a>
                </div>
                <div class="dashboard__card-icon">
                    <i class="las la-wallet"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 col-md-6 col-sm-10">
            <div class="dashboard__card">
                <div class="dashboard__card-content">
                    <h2 class="price"><i class="la la-bitcoin"></i>{{ \AdminAuth::totalWithdraw() }}</h2>
                    <p class="info">TOTAL WITHDRAW</p>
                    <a href="{{ route('admin.totalwithdraw') }}" class="view-btn">View All</a>
                </div>
                <div class="dashboard__card-icon">
                    <i class="las la-money-check"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 col-md-6 col-sm-10">
            <div class="dashboard__card">
                <div class="dashboard__card-content">
                    <h2 class="price"><i class="la la-bitcoin"></i>{{ \AdminAuth::totalWon() }}</h2>
                    <p class="info">TOTAL WON</p>
                    <a href="{{ route('admin.totalwon') }}" class="view-btn">View All</a>
                </div>
                <div class="dashboard__card-icon">
                    <i class="las la-wallet"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 col-md-6 col-sm-10">
            <div class="dashboard__card">
                <div class="dashboard__card-content">
                    <h2 class="price"><i class="la la-bitcoin"></i>{{ \AdminAuth::totalLost() }}</h2>
                    <p class="info">TOTAL LOST</p>
                    <a href="{{ route('admin.totallost') }}" class="view-btn">View All</a>
                </div>
                <div class="dashboard__card-icon">
                    <i class="las la-money-check"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 col-md-6 col-sm-10">
            <div class="dashboard__card">
                <div class="dashboard__card-content">
                    <h2 class="price"><i class="la la-bitcoin"></i>{{ \AdminAuth::currentBalance() }}</h2>
                    <p class="info">CURRENT BALANCE</p>
                    <a href="#" class="view-btn">View All</a>
                </div>
                <div class="dashboard__card-icon">
                    <i class="las la-money-check"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 col-md-6 col-sm-10">
            <div class="dashboard__card">
                <div class="dashboard__card-content">
                    <h2 class="price">{{ \AdminAuth::totaldepositRequest() }}</h2>
                    <p class="info">DEPOSIT REQUEST</p>
                    <a href="{{ route('admin.depositrequest') }}" class="view-btn">View All</a>
                </div>
                <div class="dashboard__card-icon">
                    <i class="las la-wallet"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 col-md-6 col-sm-10">
            <div class="dashboard__card">
                <div class="dashboard__card-content">
                    <h2 class="price">{{ \AdminAuth::totalwithdrawRequest() }}</h2>
                    <p class="info">WITHDRAW REQUEST</p>
                    <a href="{{ route('admin.withdrawrequest') }}" class="view-btn">View All</a>
                </div>
                <div class="dashboard__card-icon">
                    <i class="las la-money-check"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Dashboard Section Ends Here -->

@endsection
