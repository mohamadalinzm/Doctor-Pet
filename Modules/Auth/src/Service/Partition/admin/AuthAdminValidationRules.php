<?php

namespace Auth\Service\Partition\admin;

class AuthAdminValidationRules
{
    public static function login()
    {
        $rules = [
            'mobile' => ['required', 'string', 'min:9', 'max:12'],
        ];

        $messages = [
            'mobile.required' => 'Mobile number is required',
            'mobile.size' => 'Mobile number must be 11 characters',
        ];

        return [$rules,$messages];
    }

    public static function otp()
    {
        $rules = [
            'otp' => 'required|numeric|digits_between:6,10'
        ];

        $messages = [
            'otp.required' => 'OTP is required',
            'otp.numeric' => 'OTP must be numeric',
            'otp.digits_between' => 'OTP must be between 6 to 10 digits',
        ];

        return [$rules,$messages];

    }
}
