<?php

use Auth\Http\Controllers\Admin\AdminLoginController;
use Auth\Http\Controllers\Admin\AdminLogoutController;
use Auth\Http\Controllers\Admin\AdminVerifyOTPController;
use Auth\Http\Controllers\User\RefreshAuthTokenController;
use Auth\Http\Controllers\User\UserLoginController;
use Auth\Http\Controllers\User\UserLogoutController;
use Auth\Http\Controllers\User\UserRegisterController;
use Auth\Http\Controllers\User\UserLoginVerifyOTPController;
use Auth\Http\Controllers\User\UserRegisterVerifyOTPController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->prefix('api/auth')->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::post('login', [AdminLoginController::class, 'login'])
             ->name('admin.login.post')
             ->middleware('throttle:15,2');

        Route::post('login/otp/verify', [AdminVerifyOTPController::class, 'verifyOTP'])
             ->name('admin.otp.verify.post')
             ->middleware('throttle:15,2');

        Route::post('logout', [AdminLogoutController::class, 'logout'])
             ->name('admin.logout');
    });
    Route::prefix('/user')->group(function () {
        Route::post('/logout', [UserLogoutController::class, 'logout'])
             ->name('user.logout');

        Route::prefix('login')->group(function () {
            Route::post('mobile', [UserLoginController::class, 'login'])
                 ->name('login.mobile.post')
                 ->middleware('throttle:25,1');

            Route::post('mobile/verify/otp', [UserLoginVerifyOTPController::class, 'verify'])
                 ->name('login.verify-otp.post')
                 ->middleware('throttle:25,1');
        });

        Route::prefix('register')->group(function () {
            Route::post('mobile', [UserRegisterController::class, 'register'])
                 ->name('register.mobile.post');

            Route::post('mobile/verify/otp', [UserRegisterVerifyOTPController::class, 'registerVerifyOTP'])
                 ->name('register.verify-otp.post');
        });
    });
    Route::post('refresh', [RefreshAuthTokenController::class, 'refresh'])->name('refresh.token');
});


