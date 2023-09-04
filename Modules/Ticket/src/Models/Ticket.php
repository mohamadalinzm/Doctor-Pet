<?php

namespace Ticket\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use User\Model\User;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [''];

    protected $hidden = [

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
