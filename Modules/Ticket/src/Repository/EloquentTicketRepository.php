<?php

namespace Ticket\Repository;

use Illuminate\Support\Str;
use Ticket\Models\Ticket;
use Ticket\Repository\Contracts\TicketRepository;
use Morilog\Jalali\Jalalian;

class EloquentTicketRepository implements TicketRepository
{


    public function show(Ticket $ticket)
    {
        return $ticket->select(['id','ticket_number','type','title','message','status'])
            ->with(['user','comments'])
            ->get()
            ->each(function ($item) {
                $item->date = Jalalian::forge(strtotime($item->created_at))->format('Y/m/d ');
            });
    }


    public function index($searchTerm = '', $active = null)
    {
        return Ticket::select(['id','ticket_number','type','title','status'])
            ->with(['user'])
            ->search($searchTerm)->get()
            ->each(function ($item) {
                $item->date = Jalalian::forge(strtotime($item->created_at))->format('Y/m/d ');
            });
    }


    public function delete(Ticket $ticket)
    {
        $ticket->delete();
    }

    public function store($data)
    {
        return Ticket::query()->create($data);
    }

    public function update(Ticket $ticket, $data)
    {

        $ticket->update($data);

        return $ticket;
    }

}
