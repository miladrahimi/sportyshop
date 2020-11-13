<?php

use App\Http\Controllers\Front\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductsController::class, 'index'])
    ->name('home');

Route::group(['prefix' => '/products'], function () {
    Route::get('/{product}', [ProductsController::class, 'show'])
        ->name('products.show');
});
