<?php

namespace Comment\Database\Relations;

use Comment\Models\Comment;
use MedicalCenter\Models\MedicalCenter;
use Ticket\Models\Ticket;
use User\Model\User;

class CommentRelations
{
    public static function relations()
    {

        // Each User Has Many Comments
        User::resolveRelationUsing('comments',function ($user){
            return $user->hasMany(Comment::class);
        });

        User::resolveRelationUsing('doctor_comments',function ($user){
            return $user->morphMany(Comment::class.'commentable');
        });

        Ticket::resolveRelationUsing('comments',function ($ticket){
            return $ticket->morphMany(Comment::class,'commentable');
        });

        MedicalCenter::resolveRelationUsing('comments',function ($medicalCenter){
            return $medicalCenter->morphMany(Comment::class,'commentable');
        });

    }
}
