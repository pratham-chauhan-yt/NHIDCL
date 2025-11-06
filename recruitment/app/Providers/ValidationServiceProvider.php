<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidationServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Validator::extend('nospecialchar', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[^<>,!@#$%^&*()"?":{}_+\\\\]+$/', $value);
        });

        Validator::replacer('nospecialchar', function ($message, $attribute, $rule, $parameters) {
            return "The $attribute contains invalid special characters.";
        });
    }
}
