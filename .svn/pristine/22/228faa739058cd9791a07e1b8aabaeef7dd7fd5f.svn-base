@extends('layouts.dashboard')

@section('dashboard_content')
<section class="home-section">
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Change Password</div>
        </div>
    </div>

    <div class="inner_page_dash__ banner_cust_m ">
        <div class="left_side px-4">
            @include('components.alert')
            <form method="POST" id="change-password-form" action="{{ route('password.backend.update') }}">
                @csrf

                {{-- Hidden Fields --}}
                <input type="hidden" name="u_id" value="{{ old('u_id', $user->id) }}">
                <input type="hidden" name="email" value="{{ old('email', $user->email) }}">

                {{-- Current Password --}}
                <div class="inpus_cust_cs grid check_box_input mt-4">
                    <div>
                        <label class="form-label required-label" for="current_password">{{ __('Current Password') }}</label>
                        <input type="password" id="current_password" name="current_password"
                            class="form-control pe-5 password-input @error('current_password') is-invalid @enderror"
                            required autocomplete="current-password">
                        @error('current_password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                {{-- New Password --}}
                <div class="inpus_cust_cs grid check_box_input mt-4">
                    <div>
                        <label class="form-label required-label" for="new_password">{{ __('New Password') }}</label>
                        <input type="password" id="new_password" name="password"
                            class="form-control pe-5 password-input @error('password') is-invalid @enderror"
                            required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="inpus_cust_cs grid check_box_input mt-4">
                    <div>
                        <label class="form-label required-label" for="new_password_confirmation">{{ __('Re-Enter New Password') }}</label>
                        <input type="password" id="new_password_confirmation" name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            required autocomplete="new-password">
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <x-admin.captcha />

                <div class="container inner_page_dash__ mt-[20px]">
                    <button type="submit" id="login-btn" class="hover-effect-btn fill_btn">
                        <span class="btn-text">{{ __('Submit') }}</span>
                        <span class="spinner" style="display: none; margin-left: 8px;">
                            <span class="spinner-border"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
        <div class="right_pform px-4">
            <h4 class="font-semibold mb-2">🔒 <strong>Note:</strong> Your password must meet the following criteria:</h4>
            <div class="rules" id="rules">
                <p id="rule-upper-lower" class="invalid"><span>❌</span>At least one uppercase and one lowercase letter</p>
                <p id="rule-special" class="invalid"><span>❌</span>At least one special character (#, @, %, !, ^, *, =, -, +, ;, ., :)</p>
                <p id="rule-length" class="invalid"><span>❌</span>Minimum 8 characters</p>
                <p id="rule-number" class="invalid"><span>❌</span>At least one number (0–9)</p>
                <p id="rule-sequence" class="invalid"><span>❌</span>No 3+ consecutive letters or numbers (e.g., 123, abc)</p>
                <p><p>Must include one number (0-9)</p></p>
                <p>Cannot be the same as your last 3 passwords</p>
                <p>Should not include your first name, last name, domain name, or common passwords</p>
            </div>
        </div>
    </div>
</section>
@php
    if (!session()->has('salt')) {
        session(['salt' => rand(1111, 9999)]);
    }
    $saltKey = session('salt');
@endphp
@endsection
@push('scripts')
<script src="{{ asset('public/js/crypto-js.min.js') }}"></script>
@endpush