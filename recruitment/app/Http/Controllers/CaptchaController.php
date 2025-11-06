<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mews\Captcha\Captcha;
use Illuminate\Support\Facades\Response;

class CaptchaController extends Controller
{
    public function create($config = 'default')
    {
        return app('captcha')->create($config, false);
    }

    public function audio($config = 'default')
    {
        // Return audio captcha directly
        return app('captcha')->create($config, true);
    }
}
