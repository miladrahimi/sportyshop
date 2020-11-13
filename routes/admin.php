<?php

use App\Http\Controllers\Admin\Auth\SignInController;
use App\Http\Controllers\Admin\Auth\SignOutController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/auth'], function () {
    Route::get('/sign-in', [SignInController::class, 'show'])
        ->name('admin.auth.sign-in.show');
    Route::post('/sign-in', [SignInController::class, 'do'])
        ->name('admin.auth.sign-in.do');
    Route::get('/sign-out', [SignOutController::class, 'do'])
        ->name('admin.auth.sign-out.do');
});

Route::group(['middleware' => 'auth.admin'], function () {
    Route::get('/', [HomeController::class, 'show'])
        ->name('admin.home.show');

    Route::group(['prefix' => '/products'], function () {
        Route::get('/', [ProductsController::class, 'index'])
            ->name('admin.products.index');
        Route::get('/create', [ProductsController::class, 'create'])
            ->name('admin.products.create');
        Route::post('/', [ProductsController::class, 'store'])
            ->name('admin.products.store');
        Route::get('/{product}/edit', [ProductsController::class, 'edit'])
            ->name('admin.products.edit');
        Route::put('/{product}', [ProductsController::class, 'update'])
            ->name('admin.products.update');
        Route::get('/{product}/delete', [ProductsController::class, 'delete'])
            ->name('admin.products.delete');
        Route::put('/{product}/attributes', [ProductsController::class, 'updateAttributes'])
            ->name('admin.products.attributes.update');
        Route::post('/{product}/photos', [ProductsController::class, 'storePhoto'])
            ->name('admin.products.photos.store');
        Route::delete('/{product}/photos', [ProductsController::class, 'deletePhoto'])
            ->name('admin.products.photos.delete');
    });
});
