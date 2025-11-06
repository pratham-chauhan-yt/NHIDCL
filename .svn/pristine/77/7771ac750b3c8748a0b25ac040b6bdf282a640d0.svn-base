@extends('layouts.auth')
@section('auth_content')
    <form class="bg_form" method="POST" action="{{ route('auth.registration') }}">
        <div class="heading_main">
            <h5>{{ __('Registration') }}</h5>
        </div>

        @csrf
        <input type="text" class="form-control login-input @error('login') is-invalid @enderror" name="name"
            id="name" value="{{ old('name') }}" aria-describedby="nameHelp" placeholder="{{ __('Name') }}"
            autofocus autocomplete="off" required>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <input type="email" class="form-control login-input @error('login') is-invalid @enderror" name="email"
            id="email" value="{{ old('email') }}" aria-describedby="emailHelp" placeholder="{{ __('Email ID') }}"
            autofocus autocomplete="off" required>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <div class="row">
            <div class="col-md-5 col-5">
                <img src="{{ captcha_src('flat') }}" alt="Captcha Image" id="captcha-image" class="w-100 caption_border">
            </div>
            <div class="col-md-2 col-sm-2 col-2 m-auto text-center">
                <img src="{{ asset('/images/refresh.png') }}" alt="refresh" type="button" class="btn btn-refresh">
            </div>
            <div class="col-md-5 col-5">
                <input type="text" class="form-control verification_code @error('password') is-invalid @enderror"
                    aria-describedby="emailHelp" id="captcha" name="captcha" placeholder="{{ __('Verification Code') }}"
                    required autocomplete="off">
                @error('captcha')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <button type="submit" id="login-btn" class="button_form btn_custom top-to-bottom login_dash_btn">
            <span class="btn-text">{{ __('Register') }}</span>
            <span class="spinner">
                <span class="spinner-border"></span>
            </span>
        </button>
        <div class="row">
            <div class="col forgot_passowrd_">
                <a href="{{ route('auth.login') }}">{{ __('Have an account?') }}</a>
            </div>
        </div>
        <div class="orange_box"></div>
    </form>
@endsection
