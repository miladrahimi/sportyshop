<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        view()->composer('front.*', function ($view) {
            $view->with('totalProductCount', Product::count());
        });
    }
}
