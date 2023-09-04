<?php

namespace Pet\Database\Relations;


use Animal\Model\Animal;
use Pet\Model\Pet;
use User\Model\User;

class PetReverseRelation
{
    public static function relations()
    {
        User::resolveRelationUsing('pets', function ($user) {
            return $user->hasMany(Pet::class, 'user_id');
        });

        Animal::resolveRelationUsing('pets', function ($animal) {
            return $animal->hasMany(Pet::class, 'animal_id');
        });
    }
}