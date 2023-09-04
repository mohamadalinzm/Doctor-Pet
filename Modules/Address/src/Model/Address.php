<?php

namespace Address\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use User\Model\User;

class Address extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'city_id',
        'province_id',
        'type',
        'area',
        'building',
        'floor',
        'apartment',
        'latitude',
        'longitude',
        'address1',
        'address2',
        'is_active',
        'postal_code',
        'is_default',
        'hash',
    ];

    public function addressable()
    {
        return $this->morphTo();
    }


    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class,'province_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
