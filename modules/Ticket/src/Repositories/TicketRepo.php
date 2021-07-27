<?php


namespace Ticket\Repositories;


use Ticket\Models\Ticket;

class TicketRepo
{

    public function findById($id)
    {
        return Ticket::query()->findOrFail($id);
    }

    public function findOrFailWithReplies($id)
    {
        return Ticket::query()->with('replies')->findOrFail($id);

    }

    public function setStatus($id, $status)
    {
        return Ticket::query()->where("id", $id)->update(["status" => $status]);
    }

    public function paginate()
    {
        return Ticket::query()->latest()->paginate();
    }

    public function store($title)
    {
        return Ticket::query()->create([
            "title" => $title,
            "user_id" => auth()->id(),
            "status" => Ticket::STATUS_OPEN
        ]);
    }

    public function create()
    {

    }
}
