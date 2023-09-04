<?php
namespace Auth\Service\Partition\user\Validation;

use Illuminate\Support\Facades\Validator;

class UserMobileValidator
{
    public static function check($mobile)
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
