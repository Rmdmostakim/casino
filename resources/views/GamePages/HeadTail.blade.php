@extends('layouts.ClientSiteLayouts.ClientSiteApp')
@section('title','Game')
@section('content')
    <!-- inner hero section start -->
    <section class="inner-banner bg_img" style="background: url({{asset('images/inner-banner/bg2.jpg')}}) top;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-xl-6 text-center">
                    <h2 class="title text-white">Game Play</h2>
                    <ul class="breadcrumbs d-flex flex-wrap align-items-center justify-content-center">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li><a href="{{url('/games')}}">Games</a></li>
                        <li>Head or Tail</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Game section-->
    <section class="padding-top padding-bottom">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-6">
                    <div class="game-details-left">
                        <div id="coin-flip-cont">
                            <div class="coins-wrapper">
                                <div class="front"><img src="{{asset('images/game/head.png')}}" alt="game"></div>
                                <div class="back"><img src="{{asset('images/game/tail.png')}}" alt="game"></div>
                            </div>
                        </div>
                        <div class="cd-ft"></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="game-details-right">
                        <form method="get" action="{{route('HeadTail')}}">
                            <div class="container parent">
                                <div class="row">
                                    @if (session('balance'))
                                    <div class="alert text-center bg-danger text-white alert-danger">
                                        {!! session('balance') !!}
                                    </div>
                                    @endif
                                    @if( session('win') )
                                    <div class="alert badge--success text-center">
                                        <p> 
                                            <span class="mt-3 btn btn--sm radius-5"> {{ ucwords(session('choosen')) }} </span>
                                            <span class="mt-3 btn btn--sm radius-5"><i class="la la-exchange"></i></span>
                                            <span class="mt-3 btn btn--sm radius-5"> {{ ucwords(session('system_choosen')) }} </span>
                                        </p>
                                        <p class="game-status">{!! session('win') !!}</p>
                                        <audio autoplay id="myAudio">
                                            <source src="{{asset('sounds/winningsound.mp3')}}" type="audio/mp3"/>
                                            <source src="{{asset('sounds/winningsound.wav')}}" type="audio/wav"/>
                                            <source src="{{asset('sounds/winningsound.ogg')}}" type="audio/ogg"/>
                                        </audio>  
                                    </div>
                                    @endif
                                    @if( session('lose') )
                                    <div class="alert badge--danger text-center">
                                        <p> 
                                            <span class="mt-3 btn btn--sm radius-5"> {{ ucwords(session('choosen')) }} </span>
                                            <span class="mt-3 btn btn--sm radius-5"><i class="la la-exchange"></i></span>
                                            <span class="mt-3 btn btn--sm radius-5"> {{ ucwords(session('system_choosen')) }} </span>
                                        </p>
                                        <p class="game-status">{!! session('lose') !!}</p>
                                        <audio autoplay id="myAudio">
                                            <source src="{{asset('sounds/losingsound.mp3')}}" type="audio/mp3"/>
                                            <source src="{{asset('sounds/losingsound.wav')}}" type="audio/wav"/>
                                            <source src="{{asset('sounds/losingsound.ogg')}}" type="audio/ogg"/>
                                        </audio>  
                                    </div>
                                    @endif
                                    <h3 class="mb-4 text-center">Current Balance : <span class="base--color"><span class="bal">{{ \UserAuth::ucBalance() }}</span> <i class="la la-bitcoin"></i></span></h3>
                                    <div class="form-group mb-5" id="invest-handler">
                                        <div class="input-group mb-3">
                                            <input type="text" name="invest" class="form-control form--control amount-field" 
                                            value="{{ old('invest') }}" placeholder="Enter amount" required>
                                            <span class="input-group-text text-white bg--base" id="basic-addon2"><i class="la la-bitcoin"></i></span>
                                        </div>
                                        @error('invest')
                                        <div class="input-error">
                                            <span class="error-text" style="padding: 0px 5px 0px 5px;">{{ $message }}</span>
                                        </div>
                                        @enderror
                                        <small class="form-text text-muted"><i class="fas fa-info-circle mr-2"></i>Minimum: 10<i class="la la-bitcoin"></i> | Maximum: 500<i class="la la-bitcoin"></i> | <span class="text-warning">Win Amount {{ \Gameplay::gameRate('head&tail') }} %</span></small>
                                    </div>
                                    <div class="row" id="choosed-handler">
                                        <div class='col text-center'>
                                            <input type="radio" name="choosed" id="img1" class="d-none imgbgchk" value="head">
                                            <label for="img1">
                                                <img src="{{asset('images/game/head.png')}}" alt="head.png">
                                                <div class="tick_container">
                                                    <div class="tick"><i class="fa fa-check"></i></div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class='col text-center'>
                                            <input type="radio" name="choosed" id="img2" class="d-none imgbgchk" value="tail">
                                            <label for="img2">
                                                <img src="{{asset('images/game/tail.png')}}" alt="tail.png">
                                                <div class="tick_container">
                                                    <div class="tick"><i class="fa fa-check"></i></div>
                                                </div>
                                            </label>
                                        </div>
                                        @error('choosed')
                                        <div class="input-error">
                                            <span class="error-text" style="padding: 0px 5px 0px 5px;">{{ $message }}</span>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mt-5 text-center">
                                        <button type="submit" class="cmn--btn active w-100 text-center">Play Now</button>
                                        <a data-bs-toggle="modal" data-bs-target="#exampleModalCenter" class="mt-3 btn btn-link btn--sm radius-5">Game Instruction <i class="las la-info-circle"></i></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $("#invest-handler").click(function(){
            $(this).children('.input-error').empty();
        });
        $("#choosed-handler").click(function(){
            $(this).children('.input-error').empty();
        });   
    });
</script>
<!---celebration--->
@if( session('win') )
<script>
    var end = Date.now() + (3 * 1000);
    var colors = ['#bb0000', '#ffffff'];
    (function frame() {
    confetti({
        particleCount: 2,
        angle: 60,
        spread: 55,
        origin: { x: 0 },
        colors: colors
    });
    confetti({
        particleCount: 2,
        angle: 120,
        spread: 55,
        origin: { x: 1 },
        colors: colors
    });

    if (Date.now() < end) {
        requestAnimationFrame(frame);
    }
    }());
</script>
@endif
@endsection
