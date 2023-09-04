<?php

namespace Ticket\Repository\Contracts;

use Ticket\Models\Ticket;

interface TicketRepository
{
    public function show(Ticket $ticket);

    public function index();

    public function delete(Ticket $ticket);

    public function store($data);

    public function update(Ticket $ticket, $data);

}
