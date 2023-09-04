<?php

namespace Wallet\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use User\Model\User;

class Wallet extends Model
{
    use HasFactory;

    protected $guarded = [''];

    protected $hidden = [

    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

}
