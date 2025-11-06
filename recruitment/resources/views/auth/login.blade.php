@extends('layouts.recruitment-auth')
@section('auth_content')
    <div class="bg_form_">
        <h1 class="heding_style">Login</h1>
        @include('components.alert')
        <form class="inpus_cust_cs" id="login-form" method="POST" action="{{ route('auth.login') }}">
            @csrf
            <input type="hidden" name="action" value="loginall">
            <div class="relative  items-center">
                <label class="block">Email ID</label>
                <input type="email" class="form-control login-input @error('login') is-invalid @enderror" name="login"
                    id="login" value="{{ old('login') }}" aria-describedby="emailHelp"
                    placeholder="{{ __('Email ID') }}" autofocus autocomplete="off" required>
                <div class="invalid-feedback" id="emailError">
                    @error('login')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="relative items-center">
                <label class="block">Password</label>

                <div class="relative">
                    <input type="password" autocomplete="off"
                        class="form-control login-input-password pr-10 @error('password') is-invalid @enderror"
                        id="password" name="password" aria-describedby="textHelp"
                        placeholder="********" required>

                    <!-- Eye Icon -->
                    <span onclick="togglePassword()" class="absolute inset-y-0 right-5 flex items-center pr-3 cursor-pointer">
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" class="w-4 h-4 text-black-500">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 
                                4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </span>
                </div>

                <div class="invalid-feedback" id="passwordError">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>
            </div>


            <x-admin.captcha />

            <div class="flex items-center justify-between pt-2">
                <div class="flex items-start">
                    <div class="flex items-center h-5 inpus_cust_cs">
                        <input type="checkbox" class="w-4 h-4" name="remember" id="remember">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="remember" class="text-gray-500 dark:text-gray-600 cursor-pointer">Remember me</label>
                    </div>
                </div>
                <a href="{{ route('password.request') }}" class="forgot_pads_cust">Forgot password?</a>
            </div>

            <button type="submit" id="login-btn" class="fill_btn hover-effect-btn">
                <span class="btn-text">{{ __('Login') }}</span>
                <span class="spinner">
                    <span class="spinner-border"></span>
                </span>
            </button>

           <span class="text-red-500 dark:text-red-500 custom_font_size">If you are not registered, kindly register yourself
                            first.</span>
            <a href="{{ route('auth.registration') }}" class="gray_btn hover-effect-btn bg-[#AEAAA6] text-center">Registration</a>
        </form>
    </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('public/js/crypto-js.min.js') }}"></script>
@endpush
