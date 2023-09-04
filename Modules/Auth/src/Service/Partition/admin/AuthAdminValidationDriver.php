<?php

namespace Auth\Service\Partition\admin;

use App\Service\ValidationService;
use Auth\Service\AuthValidationInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use User\Service\UserResponseInterface;
use User\Service\UserValidationInterface;

class AuthAdminValidationDriver implements AuthValidationInterface
{

    public $validator;

    public $validation;

    public function __construct()
    {
        $this->validation = app(UserResponseInterface::class);
    }

    public function login(array $data, $recaptcha)
    {
        $validator_service = (new ValidationService());

        $rules = AuthAdminValidationRules::login()[0];
        $messages = AuthAdminValidationRules::login()[1];

        $currentRouteName = request()->route()->getName();
        $isApiRequest = Str::startsWith($currentRouteName, 'api.');

        $isDevelopmentEnv = app()->environment('local') || app()->environment('development') || app()->environment('testing');
        if (! $recaptcha or $isApiRequest or $isDevelopmentEnv) {
            unset($rules['g-recaptcha-response']);
        }

        $validator = $validator_service->validate($data,$rules,$messages);
        if (! $validator['isPass']) {
            $this->validation->UserValidationFailed($validator['errors']);
        }
    }

    public function otp(array $data)
    {
        $validator_service = (new ValidationService());

        $rules = AuthAdminValidationRules::otp()[0];
        $messages = AuthAdminValidationRules::otp()[1];

        $validator = $validator_service->validate($data,$rules,$messages);
        if (! $validator['isPass']) {
            $this->validation->UserValidationFailed($validator['errors']);
        }
    }

    public function register(array $data)
    {
        return null;
    }

    public function mobile(array $data)
    {
    }

    public function token(array $data)
    {
    }
}