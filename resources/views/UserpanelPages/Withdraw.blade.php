@extends('layouts.UserpanelLayouts.UserpanelApp')
@section('title','Withdraw')
@section('content')
    <div class="col-lg-9">
        <!-- Account Section Starts Here -->
        <section class="account-section overflow-hidden bg_img" style="background:url({{asset('images/account/bg.jpg')}})">
            <div class="container">
                <div class="account__main__wrapper">
                    <div class="account__form__wrapper sign-up">
                        <div class="logo"><a href="{{url('/')}}"><img src="{{asset('images/logo.png')}}" alt="logo"></a></div>
                        @if (session('success'))
                            <div class="alert badge--success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert badge--danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form class="account__form form row g-4" method="post" action="{{ route('withdraw.request') }}">
                            @csrf
                            @method('post')
                            <div class="col-xl-6 col-md-6" id="account-handler">
                                <div class="form-group">
                                    <div for="transfer_number" class="input-pre-icon"><i class="las la-phone"></i></div>
                                    <input id="transfer_number" type="text" name="transfer_number" value="{{ old('transfer_number') }}" class="form--control form-control style--two" placeholder="Your account" required>
                                </div>
                                @error('transfer_number')
                                <div class="input-error">
                                    <span class="error-text">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-6 col-md-6" id="method-handler">
                                <div class="form-group">
                                    <div for="method" class="input-pre-icon"><i class="las la-money-check"></i></div>
                                    <select id="method" name="method_name" class="form-control form--control form-control style--two" onchange="currencyConvert()">
                                        <option selected>Select method..</option>
                                        @foreach( \UserAuth::transferMethod() as $method )
                                        <option value="{{ $method->method_name }}">{{ ucfirst($method->method_name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('method_name')
                                <div class="input-error">
                                    <span class="error-text">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-6 col-md-6" id="amount-handler">
                                <div class="form-group">
                                    <div for="amount" class="input-pre-icon"><i class="la la-bitcoin"></i></div>
                                    <input id="amount" type="tel" name="balance_amount" value="{{ old('balance_amount') }}" class="form--control form-control style--two" placeholder="Amount" required onkeyup="currencyConvert()">
                                </div>
                                @error('balance_amount')
                                <div class="input-error">
                                    <span class="error-text">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="form-group">
                                    <input class="form--control form-control style--two" id="converted_amount" type="text" placeholder="UC = 0" readonly>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <button class="cmn--btn active w-100 btn--round" type="submit">Make Withdraw</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="account__content__wrapper" >
                        <div class="content text-center text-white">
                            <h3 class="title text--base mb-4">Welcome to Casinio</h3>
                            <p>
                                <i class="fas fa-quote-left fa-lg text-warning me-2"></i>
                                <span class="font-italic">Deposit in your account and get exciting bonus</span>
                                <i class="fas fa-quote-right fa-lg text-warning me-2"></i>
                            </p>
                            <a href="{{ route('faq') }}" class="mt-3 btn btn-link btn--sm radius-5">Withdraw Instruction <i class="las la-info-circle"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Account Section Ends Here -->
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("#account-handler").click(function(){
                $(this).children('.input-error').empty();
            });
            $("#amount-handler").click(function(){
                $(this).children('.input-error').empty();
            });
            $("#method-handler").click(function(){
                $(this).children('.input-error').empty();
            });
        });
        /** deposit amount convert **/
        function currencyConvert(){
            let method_name = document.getElementById("method").value;
            let balance_amount = document.getElementById("amount").value;
            axios.post("{{ route('currency.converter') }}",{method_name:method_name,balance_amount:balance_amount})
                .then(function (response) {
                    document.getElementById("converted_amount").value = 'UC = '+response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    </script>
@endsection
