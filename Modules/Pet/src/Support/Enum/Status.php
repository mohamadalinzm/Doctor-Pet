<?php

namespace Pet\Support\Enum;

use Illuminate\Validation\Rules\Enum;

class Status extends Enum
{
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';

    public static function getAsArray(): array
    {
        return [
            self::ACTIVE => 'active',
            self::INACTIVE => 'inactive',
        ];
    }
}
