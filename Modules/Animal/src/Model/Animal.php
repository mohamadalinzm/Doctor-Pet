<?php

namespace Animal\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Pet\Model\Pet;
use User\Model\User;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'creator_id',
        'name',
        'type',
        'image',
    ];

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }
}
