<div class="">
    <label class="block required-label">Captcha</label>
    <div class="flex items-start gap-4 ">
        <div class="captur flex items-center gap-6">
            <img src="{!! captcha_src('flat') !!}" alt="Captcha Image" id="captcha-image" class="w-100 caption_border">
            <div class="refresh">
                <img class="btn-refresh cursor-pointer" src="{{ asset('public/images/refresh.png') }}" alt="Captcha Refresh" type="button">
                <div class="cloader"></div>
            </div>
        </div>
        <div class="input_f inpus_cust_cs captcha_custon_input">
            <input type="text" class="form-control verification_code @error('captcha') is-invalid @enderror"
                aria-describedby="emailHelp" id="captcha" name="captcha" minlength="6" maxlength="6"
                placeholder="{{ __('Captcha Code') }}" required autocomplete="off">
            <div class="error-message" id="error-captcha"></div>
            @error('captcha')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>