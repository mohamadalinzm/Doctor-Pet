<?php

namespace Auth\Service\Partition\admin\Validation;

use Illuminate\Support\Facades\Validator;

class OTPValidator
{
    public static function check($OTP)
    {
        $data = ['otp' => $OTP];
        $rules = [
            'otp' => 'required|numeric|digits_between:6,10'
        ];
        $messages = [
            'otp.required' => 'OTP is required',
            'otp.numeric' => 'OTP must be numeric',
            'otp.digits_between' => 'OTP must be between 6 to 10 digits',
        ];

        return Validator::make($data, $rules, $messages);
    }
}
