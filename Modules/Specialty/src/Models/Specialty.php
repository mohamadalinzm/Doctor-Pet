<?php

namespace Specialty\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use User\Model\User;

class Specialty extends Model
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

    public function users()
    {
        return $this->belongsToMany(User::class);
    }


}
