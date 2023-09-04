<?php

namespace Auth\Service\Partition\user;

use Auth\Service\AuthResponseInterface;
use Auth\Service\AuthValidationInterface;
use Auth\Service\Partition\Admin\Validation\UserLoginValidator;
use Auth\Service\Partition\user\Validation\MobileValidator;
use Auth\Service\Partition\user\Validation\OTPValidator;
use Auth\Service\Partition\user\Validation\UserRegisterValidator;

class AuthUserValidationDriver implements AuthValidationInterface
{

    public function mobile(array $data)
    {
        $response = app(AuthResponseInterface::class);
        $validator = MobileValidator::check(request()->all());
        $errors = $validator->messages()->toArray();
        if ($validator->fails()) {
            return $response->AuthValidationFailed($errors);
        }

        return true;
    }

    public function otp(array $data)
    {
        $response = app(AuthResponseInterface::class);
        $validator = OTPValidator::check($data);
        $errors = $validator->messages()->toArray();

        if ($validator->fails()) {
            return $response->AuthValidationFailed($errors);
        }

        return true;
    }

    public function login(array $data , $recaptcha)
    {
        $response = app(AuthResponseInterface::class);
        $validator = UserLoginValidator::check(request()->all());
        $errors = $validator->messages()->toArray();

        if ($validator->fails()) {
            return $response->AuthValidationFailed($errors);
        }

        return true;
    }

    public function register(array $data)
    {
        $response = app(AuthResponseInterface::class);
        $validator = UserRegisterValidator::check(request()->all());
        $errors = $validator->messages()->toArray();

        if ($validator->fails()) {
            return $response->AuthValidationFailed($errors);
        }

        return true;
    }

    public function token(array $data)
    {

    }
}