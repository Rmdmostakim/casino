@extends('layouts.adminpanelLayouts.adminpanelApp')
@section('title','Edit Method')
@section('content')
    <div class="col-lg-9">
        <section class="account-section overflow-hidden bg_img" style="background:url({{asset('images/account/bg.jpg')}})">
            <div class="container">
                <div class="account__main__wrapper">
                    <div class="account__form__wrapper sign-up">
                        <div class="logo"><a href="{{url('/')}}"><img src="{{asset('images/logo.png')}}" alt="logo"></a></div>
                        <form class="account__form form row g-4" method="post" action="{{ route('admin.confirmeditmethod') }}">
                            @csrf
                            <input type="hidden" name="methodId" value="{{ \Crypt::encryptString($method->id) }}" />
                            <div class="col-xl-12 col-md-12" id="account-handler">
                                <div class="form-group">
                                    <div for="method-name" class="input-pre-icon"><i class="las la-phone"></i></div>
                                    <input id="method-name" type="text" value="{{ $method->method_name }}" class="form--control form-control style--two" readonly>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6" id="trx-number-handler">
                                <div class="form-group">
                                    <div for="trx-number" class="input-pre-icon"><i class="las la-money-check"></i></div>
                                    <input id="trx-number" name="trx_number" type="text" value="{{ $method->trx_number }}" class="form--control form-control style--two" placeholder="Transaction Number" required>
                                </div>
                                @error('trx_number')
                                <div class="input-error">
                                    <span class="error-text">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>

                            <div class="col-xl-6 col-md-6" id="rate-handler">
                                <div class="form-group">
                                    <div for="exchange-rate" class="input-pre-icon"><i class="la la-exchange"></i></div>
                                    <input id="exchange-rate" type="text" name="exchange_rate" value="{{ $method->exchange_rate }}" class="form--control form-control style--two" placeholder="Exchange Rate" required>
                                </div>
                                @error('exchange_rate')
                                <div class="input-error">
                                    <span class="error-text">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <button class="cmn--btn active w-100 btn--round" type="submit">Clcik to Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("#trx-number-handler").click(function(){
                $(this).children('.input-error').empty();
            });
            $("#rate-handler").click(function(){
                $(this).children('.input-error').empty();
            });
        });
    </script>
@endsection