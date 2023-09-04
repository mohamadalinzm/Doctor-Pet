<?php

namespace App\Service;

use Illuminate\Support\Facades\Validator;

class ValidationService
{

    public static function validate(array $data, $rules, $messages)
    {
        $validator = Validator::make($data, $rules, $messages);

        return ['isPass' => $validator->passes(), 'errors' => $validator->errors(), 'data' => request()->all()];
    }

}
