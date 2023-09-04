<?php

namespace MedicalCenter\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalCenterType extends Model
{
    use HasFactory;

    protected $guarded = [''];

    protected $hidden = [

    ];

    public function medical_center()
    {
        return $this->belongsTo(MedicalCenter::class);
    }


}
