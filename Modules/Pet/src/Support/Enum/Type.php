<?php

namespace Pet\Support\Enum;

use Illuminate\Validation\Rules\Enum;

class Type extends Enum
{
    const Work = 'Work';
    const Home = 'Home';
    const OTHER = 'Other';

    public static function getAsArray(): array
    {
        return [
            self::Work => 'Work',
            self::Home => 'Home',
            self::OTHER => 'Other',
        ];
    }

}
