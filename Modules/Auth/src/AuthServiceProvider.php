<?php

namespace Auth;

use Auth\OTP\Contract\OTP;
use Auth\OTP\Provider\OTPFakeProvider;
use Auth\OTP\Provider\OTPTwilioProvider;
use Auth\Service\AuthResponseInterface;
use Auth\Service\Partition\user\Response\AuthUserResponse;
use Illuminate\Support\ServiceProvider;
use User\Service\Repository\UserRepositoryService;
use User\Service\UserRepositoryInterface;
use User\Service\UserResponseInterface;

class AuthServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutes();
        $this->app->bind(AuthResponseInterface::class, AuthUserResponse::class);
        //$this->loadEventListeners();
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/config.php', 'auth_config');
        $this->bindOTPProvider();
    }


    public function loadRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
    }

    public function bindOTPProvider()
    {
        $this->app->bind(OTP::class, function ($app) {
            if (app()->environment('local') || app()->environment('testing')) {
                return new OTPFakeProvider();
            }
            return new OTPTwilioProvider();
        });
    }

}
