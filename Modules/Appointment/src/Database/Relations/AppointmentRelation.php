<?php

namespace Appointment\Database\Relations;


use Appointment\Models\Appointment;
use User\Model\User;

class AppointmentRelation
{
    public static function relations()
    {
        // Each User Has Many Medical Centers
        User::resolveRelationUsing('doctor_appointments',function ($user){
            return $user->hasMany(Appointment::class,'doctor_id');
        });

        User::resolveRelationUsing('customer_appointments',function ($user){
            return $user->hasMany(Appointment::class,'customer_id');
        });

        User::resolveRelationUsing('creator_appointments',function ($user){
            return $user->hasMany(Appointment::class,'creator_id');
        });
    }
}
