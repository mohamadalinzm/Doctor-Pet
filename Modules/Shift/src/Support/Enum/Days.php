<?php

namespace Shift\Support\Enum;

use Illuminate\Validation\Rules\Enum;

class Days extends Enum
{

    public static function getAsArray(): array
    {
        return [
            'Shanbe','Yekshanbe','Doshanbe','Seshanbe','Chaharshanbe','Panjshanbe','Jomeh'
        ];
    }
}
