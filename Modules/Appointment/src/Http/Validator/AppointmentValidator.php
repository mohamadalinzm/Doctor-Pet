<?php

namespace Appointment\Http\Validator;

use Illuminate\Support\Facades\Validator;

class AppointmentValidator
{
    public static function check($data)
    {
        $rules = [
            'body' => 'required',
            'rate' => 'nullable',
        ];

        return Validator::make($data, $rules);
    }
}
