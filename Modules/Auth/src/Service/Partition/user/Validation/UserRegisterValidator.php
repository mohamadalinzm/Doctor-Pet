<?php

namespace Auth\Service\Partition\user\Validation;

use Auth\Support\AuthMessage;
use Illuminate\Support\Facades\Validator;


class UserRegisterValidator
{
    public static function check(array $data)
    {
        $rules = [
            'mobile' => ['required', 'string','min:9','max:12'],
        ];

        $messages =  [
            'terms.required' => AuthMessage::$acceptTermAndConditions,
        ];

        return Validator::make($data, $rules, $messages);
    }
}
