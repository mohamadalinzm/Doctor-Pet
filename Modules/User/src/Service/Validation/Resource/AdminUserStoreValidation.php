<?php

namespace User\Service\Validation\Resource;

use Illuminate\Support\Facades\Validator;

class AdminUserStoreValidation
{
    public static function check($data)
    {
        return Validator::make($data, self::rules());
    }

    public static function rules()
    {
        return [
            'fullName' => 'required|string|max:255',
            'mobile' => 'required|numeric|unique:users',
            'email' => 'required|string|email|unique:users',
            'role_id' => 'required|exists:roles,id',
            'avatar' => 'nullable|image|max:2048',
            'birthDate' => 'required|date|before_or_equal:today',
        ];
    }
}
