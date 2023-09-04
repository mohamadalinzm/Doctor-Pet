<?php

namespace Address\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code','province_id'];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function addresses()

    {
        return $this->hasMany(Address::class);
    }
}
