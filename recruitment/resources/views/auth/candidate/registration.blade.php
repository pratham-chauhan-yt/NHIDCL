@extends('layouts.recruitment-auth')
@section('content')
    <div class="cutom_flex_p">
        @include('shared.header2')
        <div class="flex flex-col justify-between md:h-[100%] xl:h-[100vh]">
            <div class="bg_main_dash cust_corl_bg">
                <div class="container">
                    <div class="heading__regist">
                        <h3>Register Here</h3>
                    </div>
                    <div class="banner_cust_m">
                        <div class="regis_cust">
                            <div class="reg_cust_bg">
                                <x-alert />
                                <form id="registerFrm" method="POST" action="{{ route('auth.registration.store') }}"
                                    class=" inpus_cust_cs">
                                    @csrf
                                    <div class="">
                                        <div class="relative items-center mb-4">
                                            <label for="name" class="required-label block">Full Name</label>
                                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                                class="w-full @error('login') is-invalid @enderror"
                                                placeholder="Full Name" autofocus autocomplete="off" required>
                                            <div class="error-message"></div>

                                            @error('name')
                                                <span id="name_err" class="candidateErr">{{ $message }}</span>
                                            @enderror

                                        </div>
                                        <div class="relative items-center mb-4">
                                            @error('mobile')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <div class="cust_otp_veri">
                                                <div class="filed_inputs_custom">
                                                    <label for="mobile" class="required-label block">Mobile Number</label>
                                                    <input type="text" name="mobile" id="mobile"
                                                        value="{{ old('mobile') }}"
                                                        class="w-full  @error('login') is-invalid @enderror"
                                                        placeholder="Mobile Number" minlength="10" maxlength="10" autofocus autocomplete="off" oninput="this.value=this.value.replace(/[^0-9]/g,'');" required>
                                                    <div class="error-message" id="error-mobile"></div>
                                                </div>
                                                <div class="sendMobileOTPDiv">
                                                    <button type="button" class="rounded-md bg-blue-600 py-2 px-4 border border-transparent text-center text-sm text-white"
                                                        id="send_mobile_otp"> Get OTP
                                                        <span class="spinner">
                                                            <span class="spinner-border"></span>
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>


                                            <div class="cust_otp_veri verifyMobileOTPDiv d-none">
                                                <div class="filed_inputs_custom">
                                                    <label for="inputPassword4">Verify Mobile OTP</label>
                                                    <input type="text" class="form-control custom-form-control"
                                                        id="mobile_otp" placeholder="Enter mobile OTP" name="mobile_otp"
                                                        maxlength="6" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                                    <div id="authMobileOTPStatus"></div>
                                                    <span id="mobile-otp-timer" class="text-red"></span>
                                                </div>
                                                <div class="resendMobileBtnDiv d-none">
                                                    <div class="verifybtn_custom">
                                                        <button type="button" class="from-green-400 rounded-md py-2 px-4 border border-transparent text-center text-sm text-white verifyMobileOTPBtn cursor-pointer"
                                                            id="verifyMobileOTPBtn">Verify
                                                            <span class="spinner">
                                                                <span class="spinner-border"></span>
                                                            </span>
                                                        </button>
                                                        <button type="button" class="rounded-md bg-blue-600 ml-5 py-2 px-4 border border-transparent text-center text-sm text-white  resendMobileOTPBtn cursor-pointer"
                                                            id="mobile-resend-otp">Resend
                                                            <span class="spinner">
                                                                <span class="spinner-border"></span>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="relative items-center mb-4">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <div class="cust_otp_veri">
                                                <div class="filed_inputs_custom">
                                                    <label for="email" class="required-label block">Email ID</label>
                                                    <input type="text" name="email" id="email"
                                                        value="{{ old('email') }}"
                                                        class="w-full  @error('login') is-invalid @enderror"
                                                        placeholder="Email Id" autofocus autocomplete="off" required>
                                                    <div class="error-message" id="error-email"></div>
                                                </div>
                                                <div class="sendEmailOTPDiv">
                                                    <button type="button" class="rounded-md bg-blue-600 py-2 px-4 border border-transparent text-center text-sm text-white"
                                                        id="send_email_otp">Get OTP
                                                        <span class="spinner">
                                                            <span class="spinner-border"></span>
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>


                                            <div class="cust_otp_veri verifyEmailOTPDiv d-none">
                                                <div class="filed_inputs_custom">
                                                    <label for="inputPassword4">Verify Email OTP</label>
                                                    <input type="text" class="form-control custom-form-control"
                                                        id="email_otp" placeholder="Enter Email OTP" name="email_otp"
                                                        maxlength="6" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                                    <div id="authEmailOTPStatus"></div>
                                                    <span id="email-otp-timer" class="text-red"></span>
                                                </div>
                                                <div class="resendEmailBtnDiv d-none">
                                                    <div class="verifybtn_custom">
                                                        <button type="button"
                                                            class="from-green-400 rounded-md py-2 px-4 border border-transparent text-center text-sm text-white verifyEmailOTPBtn cursor-pointer"
                                                            id="verifyEmailOTPBtn">Verify
                                                            <span class="spinner">
                                                                <span class="spinner-border"></span>
                                                            </span>
                                                        </button>
                                                        <button type="button" id="email-resend-otp"
                                                            class="rounded-md bg-blue-600 ml-5 py-2 px-4 border border-transparent text-center text-sm text-white resendEmailOTPBtn cursor-pointer"
                                                            data-toggle="modal" data-target="#myModal1">Resend
                                                            <span class="spinner">
                                                                <span class="spinner-border"></span>
                                                            </span>
                                                        </button>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="relative items-center mb-4">
                                            <label for="date_of_birth" class="required-label block">Date of Birth</label>
                                            <input type="date" name="date_of_birth" id="date_of_birth"
                                                value="{{ old('date_of_birth') }}"
                                                class="w-full @error('login') is-invalid @enderror" max=""
                                                required>
                                            <div class="error-message"></div>
                                            <span id="date_of_birth_err" class="candidateErr">
                                                @if ($errors->has('date_of_birth'))
                                                    {{ $errors->first('date_of_birth') }}
                                                @endif
                                            </span>
                                        </div>

                                        <x-admin.captcha />

                                        <div class="relative items-center mt-2">
                                            <label for="checkAppln" class="flex items-center gap-2 text-[12px] whitespace-nowrap">
                                            <input type="checkbox" name="checkAppln" id="checkAppln">
                                            Have you applied for NHIDCL before?
                                            </label>
                                            <div class="relative items-center mt-2">
                                                <input type="text" name="application_id" id="application_id"
                                                    class="w-full d-none" placeholder="Application ID">
                                                <span id="application_id_err" class="candidateErr">
                                                    @if ($errors->has('application_id'))
                                                        {{ $errors->first('application_id') }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="w-[100%] justify-center flex mb-4">
                                        <button type="submit" id="registerBtn" class="mt-6 fill_btn hover-effect-btn">
                                            <span class="btn-text">{{ __('Submit') }}</span>
                                            <span class="spinner">
                                                <span class="spinner-border"></span>
                                            </span>
                                        </button>
                                    </div>
                                </form>
                                <span class=" block text-center text-[12px]">Already have an account? Click here to <a class="text-hover underline" href="{{ route('recruitment.login') }}">Login</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-footer-color p-4">
                <div class="container">
                    <p class="text-white text-center text-[12px]">@ {{ now()->year }} NHIDCL </p>
                </div>
            </footer>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('public/js/validate-method.js') }}"></script>
@endpush
