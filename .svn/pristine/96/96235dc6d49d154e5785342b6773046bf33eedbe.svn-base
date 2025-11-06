@extends('layouts.auth')

@section('auth_content')
    <div class="form_bg_inner md:block hidden">
    </div>
    <div class="bg_form_">
        <h1 class="heding_style ">
            {{ __('Reset Password') }}
        </h1>
        @include('components.alert')
        <form class="inpus_cust_cs" method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="relative  items-center">
                <label class="block">Email ID</label>
                <input type="email" class="form-control login-input @error('email') is-invalid @enderror" name="email"
                    id="email" value="{{ old('email') }}" aria-describedby="emailHelp"
                    placeholder="{{ __('Enter registered emailid') }}" autofocus autocomplete="off" required>

                <div class="invalid-feedback" id="emailError">
                    @error('email') {{ $message }} @enderror
                </div>
            </div>

            <x-admin.captcha />

            <button type="submit" id="login-btn" class="fill_btn hover-effect-btn mt-3">
                <span class="btn-text">{{ __('Send Reset Link') }}</span>
                <span class="spinner">
                    <span class="spinner-border"></span>
                </span>
            </button>
            <div class="orange_box"></div>
        </form>
        <div class="row">
            <div class="col text-center forgot_pads_cust mt-5">
                @if(session('moduleName'))
                    <a href="{{ route('recruitment.login') }}">{{ __('Back To Login?') }}</a>
                    @else
                    <a href="{{ route('auth.login') }}">{{ __('Back To Login?') }}</a>
                @endif
                
            </div>
        </div>
    </div>
    </div>
@endsection