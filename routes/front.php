<?php

use App\Http\Controllers\Front\Account\OrdersController;
use App\Http\Controllers\Front\Account\SignOutController;
use App\Http\Controllers\Front\Auth\OtpController;
use App\Http\Controllers\Front\CardController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PaymentController;
use App\Http\Controllers\Front\ProductsController;
use App\Http\Controllers\Front\Account\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'show'])
    ->name('home');

Route::group(['prefix' => '/auth/otp', 'middleware' => 'guest'], function () {
    Route::get('/', [OtpController::class, 'show'])
        ->name('auth.otp.show');
    Route::post('/', [OtpController::class, 'generate'])
        ->name('auth.otp.generate');
    Route::get('/enter', [OtpController::class, 'enter'])
        ->name('auth.otp.enter');
    Route::post('/submit', [OtpController::class, 'submit'])
        ->name('auth.otp.submit');
});

Route::group(['prefix' => '/account', 'middleware' => 'auth'], function () {
    Route::get('/sign-out', [SignOutController::class, 'do'])
        ->name('account.sign-out.do');

    Route::group(['prefix' => '/profile'], function () {
        Route::get('/', [ProfileController::class, 'show'])
            ->name('account.profile.show');
        Route::post('/', [ProfileController::class, 'update'])
            ->name('account.profile.update');
    });

    Route::group(['prefix' => '/orders'], function () {
        Route::get('/{order}', [OrdersController::class, 'show'])
            ->name('account.orders.show');
    });
});

Route::group(['prefix' => '/products'], function () {
    Route::get('/', [ProductsController::class, 'index'])
        ->name('products.index');
    Route::get('/tag/{tag}', [ProductsController::class, 'indexByTag'])
        ->name('products.tag');
    Route::get('/{product}', [ProductsController::class, 'show'])
        ->name('products.show');
});

Route::group(['prefix' => '/card'], function () {
    Route::get('/', [CardController::class, 'index'])
        ->name('card.index');

    Route::group(['middleware' => 'auth'], function () {
        Route::post('/pay', [CardController::class, 'pay'])
            ->name('card.pay');
    });
});

Route::group(['prefix' => '/payment'], function () {
    Route::post('/gateway/{order}', [PaymentController::class, 'gateway'])
        ->name('payment.gateway');
    Route::any('/callback/{bank}', [PaymentController::class, 'callback'])
        ->name('payment.callback');
});
