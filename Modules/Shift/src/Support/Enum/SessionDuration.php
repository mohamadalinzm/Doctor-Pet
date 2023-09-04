<?php

namespace Shift\Support\Enum;

use Illuminate\Validation\Rules\Enum;

class SessionDuration extends Enum
{

    public static function getAsArray(): array
    {
        return [
            10,15,20,30,45,60,90,120
        ];
    }
}
