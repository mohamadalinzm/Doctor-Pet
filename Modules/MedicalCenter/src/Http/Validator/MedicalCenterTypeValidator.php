<?php

namespace MedicalCenter\Http\Validator;

use Illuminate\Support\Facades\Validator;

class MedicalCenterTypeValidator
{
    public static function check($data)
    {
        $rules = [
            'name' => 'required|string|max:191',
            'image' => 'nullable|file|image|mimes:jpeg,jpg,png|max:2000',

        ];

        return Validator::make($data, $rules);
    }
}
