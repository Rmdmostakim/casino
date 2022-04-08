@extends('layouts.adminpanelLayouts.adminpanelApp')
@section('title','Deposit Request Confirmation')
@section('content')
    <div class="col-lg-9">
        <!-- Account Section Starts Here -->
        <section class="account-section overflow-hidden bg_img" style="background:url({{asset('images/account/bg.jpg')}})">
            <div class="container">
                <div class="account__main__wrapper">
                    <div class="account__form__wrapper sign-up">
                        <div class="logo"><a href="{{url('/')}}"><img src="{{asset('images/logo.png')}}" alt="logo"></a></div>
                        <form class="account__form form row g-4" method="post" action="{{ route('admin.confirmwithdraw') }}">
                            @csrf
                            <input type="hidden" name="withdrawId" value="{{ \Crypt::encryptString($withdraw->id) }}" />
                            <div class="col-xl-6 col-md-6" id="account-handler">
                                <div class="form-group">
                                    <div for="account-number" class="input-pre-icon"><i class="las la-phone"></i></div>
                                    <input id="account-number" type="text" value="{{ $withdraw->transfer_number }}" class="form--control form-control style--two" readonly>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6" id="method-handler">
                                <div class="form-group">
                                    <div for="method" class="input-pre-icon"><i class="las la-money-check"></i></div>
                                    <input id="trx-method" type="text" value="{{ $withdraw->transfer_method }}" class="form--control form-control style--two" readonly>
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-6" id="trxid-handler">
                                <div class="form-group">
                                    <div for="trx-id" class="input-pre-icon"><i class="la la-exchange"></i></div>
                                    <input id="trx-id" type="text" name="transection_id" value="{{ old('transection_id') }}" class="form--control form-control style--two" placeholder="Trx id" required>
                                </div>
                                @error('transection_id')
                                <div class="input-error">
                                    <span class="error-text">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="col-xl-6 col-md-6" id="amount-handler">
                                <div class="form-group">
                                    <div for="amount" class="input-pre-icon"><i class="la la-bitcoin"></i></div>
                                    <input id="amount" type="text" value="{{ $withdraw->balance_amount }}" class="form--control form-control style--two" readonly>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <input class="form--control form-control style--two text-center" id="converted_amount" type="text" placeholder="Balance to UC = {{ $withdraw->uc_amount }}" readonly>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <button class="cmn--btn active w-100 btn--round" type="submit">Confirm Withdraw</button>
                                </div>
                            </div>
                        </form>
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
            $("#trxid-handler").click(function(){
                $(this).children('.input-error').empty();
            });
        });
    </script>
@endsection
