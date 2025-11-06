@extends('layouts.recruitment-auth')
@section('auth_content')
<div class="form_bg_inner md:block hidden">
    </div>
    <div class="bg_form_">
        <h1 class="heding_style ">
            2-Step Verification
        </h1>

            @include('components.alert')
        <form class="inpus_cust_cs " method="POST" action="{{ route('recruitment.twoFactor.verify') }}">
            @csrf
            <div class="relative  items-center">
                <label class="block">Enter OTP code</label>
                <input type="text" maxlength="6" minlength="6" class="form-control login-input @error('code') is-invalid @enderror" name="code"
                id="code" value="{{ old('code') }}" aria-describedby="emailHelp" placeholder="{{ __('Enter otp code here') }}"
                autofocus autocomplete="off" required>
             
            </div>

            <x-admin.captcha />
            <button type="submit" id="login-btn" class="fill_btn hover-effect-btn">
                <span class="btn-text">{{ __('Verify') }}</span>
                <span class="spinner" style="display: none; margin-left: 8px;">
                    <span class="spinner-border"></span>
                </span>
            </button>
            <div id="countdown" class="text-muted small text-center" data-seconds="{{ $remainingSeconds }}" data-otp-url="{{ route('recruitment.twoFactor.index') }}"></div>
        </form>
    </div>
</div>
@endsection