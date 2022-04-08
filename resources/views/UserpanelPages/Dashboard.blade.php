@extends('layouts.UserpanelLayouts.UserpanelApp')
@section('title','Dashboard')
@section('content')
<!-- Dashboard Section Starts Here -->
<div class="col-lg-9">
    <div class="row justify-content-center g-4">
        <div class="col-lg-6 col-xl-4 col-md-6 col-sm-10">
            <div class="dashboard__card">
                <div class="dashboard__card-content">
                    <h2 class="price"><i class="la la-bitcoin"></i>{{ \UserAuth::ucBalance() }}</h2>
                    <p class="info">TOTAL UC BALANCE</p>
                    <a href="{{ route('user.balance') }}" class="view-btn">View All</a>
                </div>
                <div class="dashboard__card-icon">
                    <i class="las la-wallet"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 col-md-6 col-sm-10">
            <div class="dashboard__card">
                <div class="dashboard__card-content">
                    <h2 class="price"><i class="la la-bitcoin"></i>{{ \UserAuth::depositBalance() }}</h2>
                    <p class="info">TOTAL DEPOSIT</p>
                    <a href="{{ route('deposit.summary') }}" class="view-btn">View All</a>
                </div>
                <div class="dashboard__card-icon">
                    <i class="las la-wallet"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 col-md-6 col-sm-10">
            <div class="dashboard__card">
                <div class="dashboard__card-content">
                    <h2 class="price"><i class="la la-bitcoin"></i>{{ \UserAuth::withdrawBalance() }}</h2>
                    <p class="info">TOTAL WITHDRAW</p>
                    <a href="{{ route('withdraw.summary') }}" class="view-btn">View All</a>
                </div>
                <div class="dashboard__card-icon">
                    <i class="las la-money-check"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="pt-5 row gy-4 justify-content-center">
        <div class="col-lg-6 col-xl-4 col-md-6 col-sm-6">
            <div class="game-item">
                <div class="game-inner">
                    <div class="game-item__thumb">
                        <img src="{{asset('images/game/item1.png')}}" alt="game">
                    </div>
                    <div class="game-item__content">
                        <h4 class="title">Even or Odd</h4>
                        <p class="invest-info">Invest Limit</p>
                        <p class="invest-amount">$10.49 - $1,000</p>
                        <a href="{{url('/play/even-odd')}}" class="cmn--btn active btn--md radius-0">Play Now</a>
                    </div>
                </div>
                <div class="ball"></div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 col-md-6 col-sm-6">
            <div class="game-item">
                <div class="game-inner">
                    <div class="game-item__thumb">
                        <img src="{{asset('images/game/item2.png')}}" alt="game">
                    </div>
                    <div class="game-item__content">
                        <h4 class="title">Roulette</h4>
                        <p class="invest-info">Invest Limit</p>
                        <p class="invest-amount">$10.49 - $1,000</p>
                        <a href="{{url('/play/roulette')}}" class="cmn--btn active btn--md radius-0">Play Now</a>
                    </div>
                </div>
                <div class="ball"></div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 col-md-6 col-sm-6">
            <div class="game-item">
                <div class="game-inner">
                    <div class="game-item__thumb">
                        <img src="{{asset('images/game/item3.png')}}" alt="game">
                    </div>
                    <div class="game-item__content">
                        <h4 class="title">Choose A Card</h4>
                        <p class="invest-info">Invest Limit</p>
                        <p class="invest-amount">$10.49 - $1,000</p>
                        <a href="{{url('/play/choose-card')}}" class="cmn--btn active btn--md radius-0">Play Now</a>
                    </div>
                </div>
                <div class="ball"></div>
            </div>
        </div>
        <a href="{{ route('games') }}" class="btn">More Games</a>
    </div>
</div>
<!-- Dashboard Section Ends Here -->

@endsection
