<?php

namespace User\Support\Enum;

use Illuminate\Validation\Rules\Enum;

class Gender extends Enum
{
    const MALE = 'male';
    const FEMALE = 'female';
    const OTHER = 'other';

    public static function getAsArray(): array
    {
        return [
            self::MALE => 'Male',
            self::FEMALE => 'Female',
            self::OTHER => 'OTHER',
        ];
    }
}
