<?php

namespace MedicalCenter\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = [''];

    protected $hidden = [

    ];

    public function medical_centers()
    {
        return $this->belongsToMany(MedicalCenter::class,'medical_center_service', 'service_id' ,'medical_center_id');
    }

}
