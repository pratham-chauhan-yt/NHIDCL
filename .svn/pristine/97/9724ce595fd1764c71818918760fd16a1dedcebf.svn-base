@extends('layouts.auth')
@section('auth_content')
    <div class="form_bg_inner md:block hidden">
    </div>
    <div class="bg_form_">
        <h1 class="heding_style ">
            Login
        </h1>
        <form class="inpus_cust_cs " method="POST" action="{{ route('auth.loginPost') }}">
            @csrf
            <!-- <div class="">
                                    <label for="role" class="">Select Your Role</label>
                                    <select class="" name="role" id="role">
                                        <option value="hr">HR</option>
                                        <option value="candidate">Candidate</option>
                                    </select>

                                    @error('login')
        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
    @enderror
                                </div> -->

            <div class="relative  items-center">
                <label class="block">Candiadte ID</label>
                <input type="text" class="form-control login-input @error('login') is-invalid @enderror" name="login"
                    id="login" value="{{ old('login') }}" aria-describedby="emailHelp"
                    placeholder="{{ __('Candidate ID') }}" autofocus autocomplete="off" required>

                @error('login')
                    <span class="invalid-feedback candidateErr" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="relative  items-center">
                <label class="block">Password</label>
                <input type="password" class="form-control login-input-password @error('password') is-invalid @enderror"
                    id="password" name="password" aria-describedby="textHelp" placeholder="********" required>

                @error('password')
                    <span class="invalid-feedback candidateErr" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="">
                <label class="block">Captcha</label>
                <div class="flex items-center gap-4">
                    <div class="captur">
                        <img src="{{ captcha_src('flat') }}" alt="Captcha Image" id="captcha-image"
                            class="w-100 caption_border">
                    </div>
                    <div class="refresh">
                        <img class="btn-refresh cursor-pointer" src="{{ asset('/images/refresh.png') }}" alt="refresh"
                            type="button">
                    </div>
                    <div class="input_f">
                        <input type="text" class="form-control verification_code @error('password') is-invalid @enderror"
                            aria-describedby="emailHelp" id="captcha" name="captcha"
                            placeholder="{{ __('Verification Code') }}" required autocomplete="off">
                        @error('captcha')
                            <span class="invalid-feedback candidateErr" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-2">
                <div class="flex items-start">
                    <div class="flex items-center h-5 inpus_cust_cs">
                        <input type="checkbox" class="w-4 h-4" name="remember" id="remember">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="remember" class="text-gray-500 dark:text-gray-600 cursor-pointer">Remember
                            me</label>
                    </div>
                </div>
                <a href="{{ route('password.request') }}" class="forgot_pads_cust">Forgot
                    password?</a>
            </div>

            {{-- <input type="hidden" name="salt" id="salt" value="{{ session('expected_salt') }}" /> --}}

            <button type="submit" class="fill_btn hover-effect-btn">{{ __('Login') }}</button>


            <!-- <button type="submit" class=" gray_btn hover-effect-btn bg-[#AEAAA6]">Registration</button> -->
            <a href="{{ route('auth.registration') }}" class="gray_btn hover-effect-btn bg-[#AEAAA6]"
                style="text-align:center;">Registration</a>
        </form>
    </div>
    </div>
@endsection
