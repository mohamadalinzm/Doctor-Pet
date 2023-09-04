<?php

namespace MedicalCenter\Models;


use Address\Model\Address;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use User\Model\User;

class MedicalCenter extends Model
{
    use HasFactory;

    protected $guarded = [''];

    protected $hidden = [

    ];

    public function scopeSearch($query, $searchTerm = '')
    {

        if (strlen($searchTerm)) {
            $searchTerm = "%" . $searchTerm . "%";
            $query->where('name', 'like', $searchTerm);
        }
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'owner_id');
    }

    public function type()
    {
        return $this->hasOne(MedicalCenterType::class,'type_id');
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'medical_center_service', 'medical_center_id', 'service_id');
    }

}
