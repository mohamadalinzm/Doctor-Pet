<?php

namespace Specialty\Http\Validator;

use Illuminate\Support\Facades\Validator;

class SpecialtyValidator
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
