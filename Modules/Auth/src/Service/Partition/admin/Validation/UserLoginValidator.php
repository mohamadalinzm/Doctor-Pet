<?php

namespace Auth\Service\Partition\admin\Validation;

use Illuminate\Support\Facades\Validator;
<<<<<<< HEAD
use Illuminate\Support\Str;
=======
>>>>>>> 256380e0e6f9d7533466e3d2d5df4c1497b6d265

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
