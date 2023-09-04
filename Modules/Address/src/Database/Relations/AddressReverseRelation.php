<?php

namespace Address\Database\Relations;


use Address\Model\Address;
use User\Model\User;

class AddressReverseRelation
{
    public static function relations()
    {
        User::resolveRelationUsing('address',function ($role){
            return $role->hasMany(Address::class,'address_id');
        });
    }
}