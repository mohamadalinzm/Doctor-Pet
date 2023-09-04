<?php
namespace Auth\Service\Partition\admin\Validation;

use Illuminate\Support\Facades\Validator;

class MobileValidator
{
    public static function check($mobile,$validateRecaptcha = true)
    {
        $data = ['mobile' => $mobile];
        $rules = [
            'mobile' => 'required|size:11|starts_with:00',
        ];


        $messages = [
            'mobile.required' => 'Mobile number is required',
            'mobile.size' => 'Mobile number must be 11 characters',
            'mobile.starts_with' => 'Mobile number must begin with 00',
        ];

        return Validator::make($data, $rules, $messages);
    }

}