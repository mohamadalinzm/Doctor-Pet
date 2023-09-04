<?php

namespace Specialty\Database\Relations;

use Specialty\Models\Specialty;
use User\Model\User;

class SpecialtyRelation
{
    public static function relations()
    {

        // Each User Has Many Medical Centers
        User::resolveRelationUsing('specialties',function ($user){
            return $user->belongsToMany(Specialty::class);
        });

    }
}
