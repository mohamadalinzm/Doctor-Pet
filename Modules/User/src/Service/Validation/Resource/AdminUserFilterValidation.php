<?php

namespace User\Service\Validation\Resource;

use Illuminate\Support\Facades\Validator;

class AdminUserFilterValidation
{
    public static function check($data,$user)
    {
        $data = [
            'mobile' => $mobile,
        ];
        $rules = [
            'mobile' => ['required', 'string', 'min:9', 'max:12'],
        ];
        return Validator::make($data, $rules);
    }
}
