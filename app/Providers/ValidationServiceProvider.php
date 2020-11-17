<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{
    /** @noinspection PhpUnusedParameterInspection */
    public function boot()
    {
        Validator::extend('cellphone', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^09[0-9]{9}$/',  $value);
        });
    }
}
