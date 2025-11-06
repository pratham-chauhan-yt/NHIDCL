@extends('layouts.recruitment-auth')

@section('auth_content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-hidden">
                    <div class="row g-0">

                        <div class="col-lg-6">
                            <div class="bg_form_">
                                <div>
                                    <h5 class="text-primary">{{ __('Reset Password') }}</h5>
                                </div>
                                @include('components.alert')
                                <form class="inpus_cust_cs mb-4" id="password-change" method="POST" action="{{ route('recruitment.password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <input type="hidden" name="email" value="{{ old('email', request()->get('email')) }}">
                                    <div class="mb-3">
                                        <label class="form-label" for="password-input">{{ __('Password') }}</label>
                                        <input type="password" name="password" id="password-input" class="form-control pe-5 password-input @error('password') is-invalid @enderror" required autocomplete="off" minlength="8" pattern="^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$" title="Password must be at least 8 characters long, include one uppercase letter, one number, and one special character.">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="password-input">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" pattern="^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$" title="Confirm password must match the format of the new password" required autocomplete="off">
                                    </div>
                                    <x-admin.captcha />
                                    <div class="mt-4 text-center">
                                        <button type="submit" id="login-btn" class="fill_btn hover-effect-btn">
                                            <span class="btn-text">{{ __('Reset Password') }}</span>
                                            <span class="spinner" style="display: none; margin-left: 8px;">
                                                <span class="spinner-border"></span>
                                            </span>
                                        </button>
                                    </div>
                                </form>
                                <small class="form-text">
                                    Password must be at least <strong>8 characters</strong>, include at least <strong>one uppercase letter</strong>, <strong>one number</strong>, and <strong>one special character</strong>.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="{{ asset('public/js/crypto-js.min.js') }}"></script>
@endpush
