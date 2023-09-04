<?php

namespace Ticket\Http\Validator;

use Illuminate\Support\Facades\Validator;

class TicketValidator
{
    public static function check($data)
    {
        $rules = [
            'title' => 'required|string|max:191',
            'message' => 'required',
            'type' => 'required',
            'status' => 'required',
            'ticket_number' => 'required',
            'user_id' => 'required',
        ];

        return Validator::make($data, $rules);
    }
}
