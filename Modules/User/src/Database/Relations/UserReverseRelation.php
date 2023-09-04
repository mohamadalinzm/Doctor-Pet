<?php

namespace User\Database\Relations;

use App\Models\User;

class UserReverseRelation
{
    public static function relations()
    {
        //Role::resolveRelationUsing('users',function ($role){
        //    return $role->hasMany(User::class,'role_id');
        //});
    }
}