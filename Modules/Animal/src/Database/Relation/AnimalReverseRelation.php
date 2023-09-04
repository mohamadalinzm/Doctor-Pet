<?php

namespace Animal\Database\Relation;
use Animal\Model\Animal;

class AnimalReverseRelation
{
    public static function relations()
    {
        Animal::resolveRelationUsing('animal',function ($animal){
            return $animal->hasMany(Animal::class,'animal_id');
        });
    }
}