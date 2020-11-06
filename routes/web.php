<?php

use App\Http\Controllers\Admin\Auth\SignInController as AdminAuthSignInController;
use App\Http\Controllers\Admin\Auth\SignOutController as AdminAuthSignOutController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProductsController as AdminProductsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/admin', 'middleware' => 'admin'], function () {
    Route::group(['prefix' => '/auth'], function () {
        Route::get('/sign-in', [AdminAuthSignInController::class, 'show'])
            ->name('admin.auth.sign-in.show');
        Route::post('/sign-in', [AdminAuthSignInController::class, 'do'])
            ->name('admin.auth.sign-in.do');
        Route::get('/sign-out', [AdminAuthSignOutController::class, 'do'])
            ->name('admin.auth.sign-out.do');
    });

    Route::group(['middleware' => 'auth.admin'], function () {
        Route::get('/', [AdminHomeController::class, 'show'])
            ->name('admin.home.show');

        Route::group(['prefix' => '/products'], function () {
            Route::get('/', [AdminProductsController::class, 'index'])
                ->name('admin.products.index');
            Route::get('/create', [AdminProductsController::class, 'create'])
                ->name('admin.products.create');
            Route::post('/', [AdminProductsController::class, 'store'])
                ->name('admin.products.store');
            Route::get('/{product}/edit', [AdminProductsController::class, 'edit'])
                ->name('admin.products.edit');
            Route::put('/{product}', [AdminProductsController::class, 'update'])
                ->name('admin.products.update');
            Route::get('/{product}/delete', [AdminProductsController::class, 'delete'])
                ->name('admin.products.delete');
            Route::put('/{product}/attributes', [AdminProductsController::class, 'updateAttributes'])
                ->name('admin.products.attributes.update');
            Route::post('/{product}/photos', [AdminProductsController::class, 'storePhoto'])
                ->name('admin.products.photos.store');
            Route::delete('/{product}/photos', [AdminProductsController::class, 'deletePhoto'])
                ->name('admin.products.photos.delete');
        });
    });
});
