<?php

namespace MedicalCenter\Database\Relations;

use MedicalCenter\Models\MedicalCenter;
use User\Model\User;

class MedicalCenterRelation
{
    public static function relations()
    {

        // Each User Has Many Medical Centers
        User::resolveRelationUsing('medicalCenters',function ($user){
            return $user->hasMany(MedicalCenter::class);
        });

    }
}
