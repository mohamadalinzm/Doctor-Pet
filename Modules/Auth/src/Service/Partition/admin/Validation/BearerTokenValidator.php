<?php
namespace Auth\Service\Partition\admin\Validation;

use Illuminate\Support\Facades\Validator;

class BearerTokenValidator
{
    public static function check($token)
    {
        $data = ['token' => $token];
        $rules = ['token' => 'required|bearer_token'];
        return Validator::make($data, $rules);
    }

}