<?php


namespace Ticket\Services;


use Media\Services\MediaFileService;
use Ticket\Models\Ticket;
use Ticket\Repositories\ReplyRepo;
use Ticket\Repositories\TicketRepo;

class ReplyService
{
    public static function store($ticket, $reply, $attachment)
    {
        $repo = new ReplyRepo();
        $ticketRepo = new TicketRepo();
        $media_id = null;
        if ($attachment) {
            $media_id = MediaFileService::privateUpload($attachment)->id;
        }

        $reply = $repo->store($ticket->id, $reply, $media_id);
        if ($reply->user_id != $ticket->user_id) {
            $ticketRepo->setStatus($ticket->id, Ticket::STATUS_ANSWERED);
        }
        return $reply;


    }
}
