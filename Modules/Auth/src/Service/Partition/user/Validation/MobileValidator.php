<?php
namespace Auth\Service\Partition\user\Validation;

use Illuminate\Support\Facades\Validator;

class MobileValidator
{
    public static function check($data,$validateRecaptcha = true)
    {

        $rules = [
            'mobile' => 'required|size:11',
        ];


        $messages = [
            'mobile.required' => 'Mobile number is required',
            'mobile.size' => 'Mobile number must be 11 characters',
        ];

        return Validator::make($data, $rules, $messages);
    }

}
