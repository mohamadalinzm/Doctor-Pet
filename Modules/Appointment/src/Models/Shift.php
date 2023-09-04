<?php

namespace Appointment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use User\Model\User;

class Shift extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function doctor()
    {
        return $this->belongsTo(User::class,'doctor_id');
    }

}
