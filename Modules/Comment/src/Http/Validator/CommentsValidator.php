<?php

namespace Comment\Http\Validator;

use Illuminate\Support\Facades\Validator;

class CommentsValidator
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
