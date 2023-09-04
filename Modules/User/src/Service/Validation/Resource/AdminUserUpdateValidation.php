<?php

namespace User\Service\Validation\Resource;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminUserUpdateValidation
{
    public static function check($data,$userId)
    {
        return Validator::make($data, self::rules($userId));
    }

    public static function rules($userId)
    {
        return [
            'fullname' => 'sometimes|required|string|max:255',
            'mobile' => ['sometimes', 'required', 'numeric', Rule::unique('users')->ignore($userId)],
            'email' => ['sometimes', 'required', 'string', 'email', Rule::unique('users')->ignore($userId)],
            'role_id' => 'sometimes|required|exists:roles,id',
            'avatar' => 'nullable|image|max:2048',
            'birthDate' => 'sometimes|required|date|before_or_equal:today',
        ];
    }
}
