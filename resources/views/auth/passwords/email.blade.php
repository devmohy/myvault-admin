@extends('layouts.auth')

@section('content')
<div class="header bg-primary py-7 py-lg-8 pt-lg-9 rounded-bottom">
    <div class="container">
        <div class="header-body text-center mb-5 d-flex flex-column align-items-center">
            <div class="bg-white rounded-circle text-center">
                <img width="100" class="img-fluid rounded-circle" src="{{ asset('assets/img/logo.jpg') }}"
                    alt="">
            </div>
            <div class="justify-content-center">
                <h1 class="text-white">Forgot Password</h1>
                <p class="text-lead text-white">Enter your email reset password.</p>
            </div>
        </div>
    </div>
</div>
<div class="container mt--9 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>
                <div class="card-body">
                    @include('flash::message')
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.phone') }}">
                        @csrf
                        <div class="form-group">
                            <label for="phone_number" class="col-form-label text-md-right">{{ __('Phone Number') }}</label>

                            <div class="">
                                <input id="phone_number" type="tell" class="form-control @error('phone_number') is-invalid @enderror" placeholder="EG: 08162875010" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
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
