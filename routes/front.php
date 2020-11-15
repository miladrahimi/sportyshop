<?php

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'show'])
    ->name('home');

Route::group(['prefix' => '/products'], function () {
    Route::get('/', [ProductsController::class, 'index'])
        ->name('products.show');
    Route::get('/tag/{tag}', [ProductsController::class, 'tag'])
        ->name('products.tag');
    Route::get('/{product}', [ProductsController::class, 'show'])
        ->name('products.show');
});
