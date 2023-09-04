<?php

namespace Auth\Service\Partition\user\Validation;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CountryCodeValidator
{
    public static function check($countyCode)
    {
        $data = ['country_code' => $countyCode];
        $rules = [
            'country_code' => [
                'required',
            ],
        ];
        return Validator::make($data, $rules);
    }
}
