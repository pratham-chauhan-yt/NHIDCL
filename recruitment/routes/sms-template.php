<?php

use App\Http\Controllers\SmsTemplateController;
use Illuminate\Support\Facades\Route;



Route::prefix('sms')->group(function () {
    Route::resource('/templates', SmsTemplateController::class)->names('template');
});

