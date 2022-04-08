@extends('layouts.adminpanelLayouts.adminpanelApp')
@section('title','Password Setting')
@section('content')
<div class="col-lg-9">
    <div class="custom--card section-bg">
        <div class="card--body section-bg p-sm-5 p-3">
            <div class="reset-header mb-5 text-center">
                <div class="icon"><i class="las la-lock"></i></div>
                <h3 class="mt-3">Reset Password</h3>
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
            </div>
            <form autocomplete="off" method="post" action="{{ route('admin.passwordreset') }}">
                @csrf
                @method('post')
                <div id="password-handler">
                    <div class="form-group mb-3">
                        <label class="form-label" for="password">Current Password</label>
                        <input id="password" type="password" name="password" class="form-control form--control"
                               value="{{ old('password') }}" required="" autocomplete="off">
                    </div>
                    @error('password')
                    <div class="input-error badge--danger">
                        <span class="error-text">{{ $message }}</span>
                    </div>
                    @enderror
                </div>

                <div id="new_password-handler">
                    <div class="form-group mb-3">
                        <label class="form-label" for="password">Password</label>
                        <input id="new_password" type="password" name="new_password" class="form-control form--control" name="new_password" required="" autocomplete="off">
                    </div>
                    @error('new_password')
                    <div class="input-error badge--danger">
                        <span class="error-text">{{ $message }}</span>
                    </div>
                    @enderror
                </div>

                <div id="confirmed_password-handler">
                    <div class="form-group mb-3">
                        <label class="form-label" for="confirm_password">Confirm Password</label>
                        <input id="new_password_confirm" type="password" name="new_password_confirm" class="form-control form--control" name="password_confirmation" required="" autocomplete="off">
                    </div>
                    @if (session('not-matched'))
                        <div class="input-error badge--danger">
                            <span class="error-text">{{ session('not-matched') }}</span>
                        </div>
                    @endif
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="cmn--btn active w-100">Change Password</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("#password-handler").click(function(){
                $(this).children('.input-error').empty();
            });
            $("#new_password-handler").click(function(){
                $(this).children('.input-error').empty();
            });
            $("#confirmed_password-handler").click(function(){
                $(this).children('.input-error').empty();
            });
        });
    </script>
@endsection
