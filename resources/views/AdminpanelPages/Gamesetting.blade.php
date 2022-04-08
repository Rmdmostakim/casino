@extends('layouts.adminpanelLayouts.adminpanelApp')
@section('title','Game Setting')
@section('content')
    <div class="col-lg-9">
        @if (session('success'))
            <div class="col-md-12 col-xl-12 alert text-center badge--success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="col-md-12 col-xl-12 alert badge--danger text-center">
                {{ session('error') }}
            </div>
        @endif
        <div class="game-rate">
            <p class="btn btn--primary btn--sm">Game Rate in Percent</p>
            <div class="mb-5 mt-2">
                <form class="account__form form row g-4" method="post" action="{{ route('admin.rateupdate') }}">
                    @csrf
                    @foreach( \AdminAuth::gameRate() as $game)
                    <div class="col-xl-12 col-md-12">
                        <div class="form-group">
                            <div for="{{$game->game_name}}" class="input-pre-icon">{{ ucwords($game->game_name) }}</div>
                            <input id="{{$game->game_name}}" type="text" name="{{ str_replace( '&', '', $game->game_name) }}" value="{{$game->game_rate}}" class="form--control form-control text-center style--two" placeholder="Game Rate in percentage" required>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-lg-12">
                        <div class="form-group">
                            <button class="cmn--btn active btn--sm w-100 btn--round" type="submit">Update Game Rate</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="tansection-method">
            <p class="btn btn--primary btn--sm mb-2">Transection Methods</p>
            <div class="table--responsive--md">
                <table class="table text-center" id="dataTable">
                    <thead>
                    <tr>
                        <th>Method Name</th>
                        <th>Transection Number</th>
                        <th>Exchange Rate</th>
                        <th>Status</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( \AdminAuth::transectionMethod() as $method)
                        <tr>
                            <td class="game-name" data-label="Game Name">{{ ucwords($method->method_name) }}</td>
                            <td class="number" data-label="Number">{{ $method->trx_number }}</td>
                            <td class="amount" data-label="Amount"> {{ $method->exchange_rate }} </td>
                            @if($method->status == 1)
                            <td class="status" data-label="Status"><p class="btn btn--success btn--sm">Active</p></td>
                            @else
                            <td class="status" data-label="Status"><p class="btn btn--danger btn--sm">Inactive</p></td>
                            @endif
                            @if($method->status == 1)
                                <td class="options" data-label="Options">
                                    <a href="{{ route('admin.editmethod',\Crypt::encryptString($method->id)) }}" title="Edit"><i class="la la-pen-square"></i></a>
                                    <i class="la la-pause"></i>
                                    <a href="{{ route('admin.deactivatedmethod',\Crypt::encryptString($method->id)) }}" title="Inactive"><i class="fa-solid fa-circle-xmark"></i></a>
                                </td>
                            @else
                            <td class="options" data-label="Options">
                                <i class="la la-pen-square"></i>
                                <i class="la la-pause"></i>
                                <a href="{{ route('admin.activatemethod',\Crypt::encryptString($method->id)) }}" title="Active"><i class="fa-solid fa-circle-check"></i></a>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="account__main__wrapper">
                    <form class="account__form form row g-4" method="post" action="{{ route('admin.addmethod') }}">
                        @csrf
                        <div class="col-xl-6 col-md-6" id="method-handler">
                            <div class="form-group">
                                <div for="method" class="input-pre-icon">Method Name</div>
                                <input id="method" type="text" name="method_name" value="{{ old('method') }}" class="form--control form-control text-center style--two" placeholder="Method Name" required>
                            </div>
                            @error('method_name')
                            <div class="input-error">
                                <span class="error-text">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="col-xl-6 col-md-6" id="trx-number-handler">
                            <div class="form-group">
                                <div for="trx-number" class="input-pre-icon">Number</div>
                                <input id="trx-number" type="text" name="trx_number" value="{{ old('trx_number') }}" class="form--control form-control text-center style--two" placeholder="Transaction Number" required>
                            </div>
                            @error('trx_number')
                            <div class="input-error">
                                <span class="error-text">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="col-xl-6 col-md-6" id="rate-handler">
                            <div class="form-group">
                                <div for="amount" class="input-pre-icon">Exchange Rate</div>
                                <input id="amount" type="text" name="exchange_rate" value="{{ old('exchange_rate') }}" class="form--control form-control text-center style--two" placeholder="Exchange Rate" required>
                            </div>
                            @error('exchange_rate')
                            <div class="input-error">
                                <span class="error-text">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <button class="cmn--btn active btn--sm w-100 btn--round" type="submit">Add New Method</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="signup-event">
            <p class="btn btn--primary btn--sm mb-2">Deposit Events</p>
            <div class="table--responsive--md">
                <table class="table text-center" id="dataTable">
                    <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Offer</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( \AdminAuth::getEvent() as $event)
                        <tr>
                            <td class="game-name" data-label="Game Name"> Signup Event</td>
                            <td class="amount" data-label="Amount"> {{ $event->event }} </td>
                            @if($event->status == 1)
                                <td class="status" data-label="Status"><p class="btn btn--success btn--sm">Active</p></td>
                            @else
                                <td class="status" data-label="Status"><p class="btn btn--danger btn--sm">Inactive</p></td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    <form class="account__form form row g-4" method="post" action="{{ route('admin.addoffer') }}">
                        @csrf
                        <div class="col-xl-12 col-md-12" id="offer-handler">
                            <div class="form-group">
                                <div for="method" class="input-pre-icon">Offer</div>
                                <input id="method" type="text" name="offer" value="{{ old('offer') }}" class="form--control form-control text-center style--two" placeholder="Signup Offer Price" required>
                            </div>
                            @error('offer')
                            <div class="input-error">
                                <span class="error-text">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <button class="cmn--btn active btn--sm w-100 btn--round" type="submit">Add New Offer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("#method-handler").click(function(){
                $(this).children('.input-error').empty();
            });
            $("#trx-number-handler").click(function(){
                $(this).children('.input-error').empty();
            });
            $("#rate-handler").click(function(){
                $(this).children('.input-error').empty();
            });
            $("#offer-handler").click(function(){
                $(this).children('.input-error').empty();
            });
        });
    </script>
@endsection
