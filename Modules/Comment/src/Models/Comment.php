<?php

namespace Comment\Models;

use Illuminate\Database\Eloquent\Model;
use User\Model\User;

class Comment extends Model
{
    protected $guarded = [];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
