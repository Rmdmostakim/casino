@extends('layouts.siteLayout')
@section('title','Home')

@section('content')
<div class="container-fluid jumbotron homeBody" >
    <div class="container">
        <div class="row">
            <div class="col-sm text-center top-10">
                <img src="{{asset('icon/homeicon.png')}}"/>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm pt-3">
                <div class="card">
                    <img class="card-img-top card-img-width" src="{{asset('icon/headtails.gif')}}" alt="Card image cap">
                    <div class="card-body text-center">
                        <h5 class="card-title">Head & Tail</h5>
                        <a href="head&tails" class="btn btn-primary">Play</a>
                    </div>
                </div>
            </div>
            <div class="col-sm pt-3">
                <div class="card">
                    <img class="card-img-top card-img-width" src="{{asset('icon/evenodds.gif')}}" alt="Card image cap">
                    <div class="card-body text-center">
                        <h5 class="card-title">Even & Odd</h5>
                        <a href="even&odds" class="btn btn-primary">Play</a>
                    </div>
                </div>
            </div>
            <div class="col-sm pt-3">
                <div class="card">
                    <img class="card-img-top card-img-width" src="{{asset('icon/kingqueen.gif')}}" alt="Card image cap">
                    <div class="card-body text-center">
                        <h5 class="card-title">King & Queen</h5>
                        <a href="king&queen" class="btn btn-primary">Play</a>
                    </div>
                </div>
            </div>
            <div class="col-sm pt-3">
                <div class="card">
                    <img class="card-img-top card-img-width" src="{{asset('icon/spin.gif')}}" alt="Card image cap">
                    <div class="card-body text-center">
                        <h5 class="card-title">Spin & Win</h5>
                        <a href="spin&win" class="btn btn-primary">Play</a>
                    </div>
                </div>
            </div>
            <div class="col-sm pt-3">
                <div class="card">
                    <img class="card-img-top card-img-width" src="{{asset('icon/roulette.gif')}}" alt="Card image cap">
                    <div class="card-body text-center">
                        <h5 class="card-title">Roulette Table</h5>
                        <a href="roulette" class="btn btn-primary">Play</a>
                    </div>
                </div>
            </div>
            <div class="col-sm pt-3">
                <div class="card">
                    <img class="card-img-top card-img-width" src="{{asset('icon/cardsgame.gif')}}" alt="Card image cap">
                    <div class="card-body text-center">
                        <h5 class="card-title">Choose a Card</h5>
                        <a href="choosecard" class="btn btn-primary">Play</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection