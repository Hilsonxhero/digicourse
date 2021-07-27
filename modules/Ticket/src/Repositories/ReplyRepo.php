<?php


namespace Ticket\Repositories;


use Ticket\Models\Reply;
use Ticket\Models\Ticket;

class ReplyRepo
{

    public function store($ticket, $body, $media_id = null)
    {
        return Reply::query()->create([
            "user_id" => auth()->id(),
            "ticket_id" => $ticket,
            "body" => $body,
            "media_id" => $media_id
        ]);
    }

}
