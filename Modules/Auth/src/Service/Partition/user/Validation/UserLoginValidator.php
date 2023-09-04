<?php

namespace Auth\Service\Partition\user\Validation;

use Illuminate\Support\Facades\Validator;

class UserLoginValidator
{
    public static function check(array $data)
    {
        $rules = [
            'mobile' => ['required','string','min:9','max:12'],
        ];

        return Validator::make($data, $rules);
    }
}
