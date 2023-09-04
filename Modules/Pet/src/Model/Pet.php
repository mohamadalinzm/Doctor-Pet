<?php

namespace Pet\Model;

use Animal\Model\Animal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use User\Model\User;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'animal_id',
        'race',
        'age',
        'type',
        'kind',
        'avatar',
        'birthDate'
    ];

    protected $dates = [
        'birthDate'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
