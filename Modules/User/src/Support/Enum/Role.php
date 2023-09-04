<?php

namespace User\Support\Enum;

use Illuminate\Validation\Rules\Enum;

class Role extends Enum
{

    public const RoleADMIN = 'admin';

    public const RoleEMPLOYEE = 'employee';

    public const RoleCUSTOMER = 'customer';

    public const RoleSELLER = 'seller';

    public const ADMIN = 3;

    public const EMPLOYEE = 2;

    public const CUSTOMER = 1;

    public const SELLER = 4;

    public static function getAsArray(): array
    {
        return [
            self::ADMIN => 'Admin',
            self::EMPLOYEE => 'Employee',
            self::CUSTOMER => 'Customer',
            self::SELLER => 'Seller',
        ];
    }

    public static function getAsDatabase()
    {
        return Role::query()->select(['id', 'name'])->where('scope', Scope::ADMIN)->get();
    }

    public static function systemRole()
    {
        return Role::query()->select(['id', 'name'])->where('scope', Scope::ADMIN)->get();
    }

    public static function storeRole()
    {
        return Role::query()->select(['id', 'name'])->where('scope', Scope::SELLER)->get();
    }
}
