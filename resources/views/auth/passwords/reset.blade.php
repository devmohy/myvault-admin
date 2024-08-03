@extends('layouts.auth')

@section('content')
<div class="header bg-primary py-7 py-lg-8 pt-lg-9 rounded-bottom">
    <div class="container">
        <div class="header-body text-center mb-7 d-flex flex-column align-items-center">
            <div class="bg-white rounded-circle text-center py-2 px-4">
                <img width="50" class="img-fluid" src="{{ asset('assets/img/logo-blue.png') }}" alt="">
            </div>
            <div class="justify-content-center">
                <h1 class="text-white">SoundmindsGas</h1>
                <p class="text-lead text-white">Fill form below to change your passord.</p>
            </div>
        </div>
    </div>
    {{-- <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div> --}}
</div>
<div class="container  mt--9 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Reset Password') }}
                </div>

                <div class="card-body">
                    @include('flash::message')
                    <form method="POST" action="{{ route('password.phone.update') }}">
                        @csrf

                        {{-- <input type="hidden" name="token" value="{{ $token }}"> --}}

                        <div class="form-group">
                            <label for="otp" class="col-form-label text-md-right">{{ __('OTP') }}</label>

                            <div>
                                <input id="otp" type="number" class="form-control @error('otp') is-invalid @enderror" name="otp" value="{{ old('phone_number') }}" required autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
