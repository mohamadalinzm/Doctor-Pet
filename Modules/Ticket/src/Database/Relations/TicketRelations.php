<?php

namespace Ticket\Database\Relations;

use Comment\Models\Comment;
use Ticket\Models\Ticket;
use User\Model\User;

class TicketRelations
{
    public static function relations()
    {

        // Each User Has Many Tickets
        User::resolveRelationUsing('tickets',function ($user){
            return $user->hasMany(Ticket::class);
        });

    }
}
