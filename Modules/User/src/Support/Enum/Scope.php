<?php

namespace User\Support\Enum;

use Illuminate\Validation\Rules\Enum;

class Scope extends Enum
{
    public const ADMIN = 1;

    public const USER = 2;

    public const  EMPLOYEE = 3;

    public static function getAsArray(): array
    {
        return [
            self::ADMIN => 'Admin',
            self::USER => 'USER',
            self::EMPLOYEE => 'Employee',
        ];
    }

    public static function getAsDatabase(): array
    {
        return Role::query()->select(['id', 'name'])->get();
    }
}
