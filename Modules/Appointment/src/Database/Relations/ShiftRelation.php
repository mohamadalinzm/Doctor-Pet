<?php

namespace Appointment\Database\Relations;

use Appointment\Models\Shift;
use User\Model\User;

class ShiftRelation
{
    public static function relations()
    {
        // Each User Has Many Medical Centers
        User::resolveRelationUsing('doctor_shifts',function ($user){
            return $user->hasMany(Shift::class,'doctor_id');
        });

        User::resolveRelationUsing('creator_shifts',function ($user){
            return $user->hasMany(Shift::class,'creator_id');
        });
    }
}
