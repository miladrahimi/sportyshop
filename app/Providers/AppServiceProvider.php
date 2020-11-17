<?php

namespace App\Providers;

use App\Services\Sms\FakeSmsProvider;
use App\Services\Sms\Sms;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Sms::class, FakeSmsProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Str::startsWith(config('app.url'), 'https')) {
            URL::forceScheme('https');
        }

        require(__DIR__ . '/../Services/helpers.php');
    }
}
