<?php

namespace Shift\Service\Validation\Resource;

use Illuminate\Validation\Rule;
use Shift\Support\Enum\Days;
use Shift\Support\Enum\SessionDuration;

class AdminValidationRules
{
    public static function Store(): array
    {
        return [
            'doctor_id' => ['required', 'exists:users,id'],
            'day' => ['required', Rule::in(Days::getAsArray())],
            'session_duration' => ['required', 'string', Rule::in(SessionDuration::getAsArray())],
            'start_time' => ['required', 'date', 'before:end_time'],
            'end_time' => ['required', 'date', 'after:start_time'],
        ];
    }

    public static function Update($Shift_id): array
    {
        return [
            'doctor_id' => [
                'sometimes',
                'exists:users,id',
                Rule::unique('shifts')->ignore($Shift_id),
            ],
            'day' => ['sometimes', Rule::in(Days::getAsArray())],
            'session_duration' => ['sometimes', 'string', Rule::in(SessionDuration::getAsArray())],
            'start_time' => 'sometimes|date',
            'end_time' => 'sometimes|date|after:start_time',
        ];
    }

}
