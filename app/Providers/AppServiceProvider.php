<?php

namespace App\Providers;

use App\Services\Sms\Candoo;
use App\Services\Sms\Log as SmsLog;
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
        switch (config('sms.driver')) {
            case 'log':
                $this->app->singleton(Sms::class, SmsLog::class);
                break;
            case 'candoo':
                $this->app->singleton(Sms::class, Candoo::class);
                break;
        }
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
