<?php

namespace Appointment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use User\Model\User;

class Appointment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function doctor()
    {
        return $this->belongsTo(User::class,'doctor_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class,'customer_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'creator_id');
    }

}
