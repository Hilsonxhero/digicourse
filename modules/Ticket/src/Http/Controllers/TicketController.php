<?php

namespace Ticket\Http\Controllers;

use App\Http\Controllers\Controller;
use Media\Services\MediaFileService;
use Ticket\Http\Requests\ReplyRequest;
use Ticket\Http\Requests\TicketRequest;
use Ticket\Models\Reply;
use Ticket\Models\Ticket;
use Illuminate\Http\Request;
use Ticket\Repositories\TicketRepo;
use Ticket\Services\ReplyService;

class TicketController extends Controller
{
    public $repo;

    public function __construct(TicketRepo $ticketRepo)
    {
        $this->repo = $ticketRepo;
    }

    public function index()
    {
        $tickets = $this->repo->paginate();
        return view("Ticket::index", compact('tickets'));
    }


    public function create()
    {
        return view("Ticket::create");
    }


    public function store(TicketRequest $request)
    {
        $ticket = $this->repo->store($request->title);
        ReplyService::store($ticket, $request->body, $request->file("attachment"));

        newFeedback();
        return redirect()->route('tickets.index');
    }

    public function show($ticket)
    {
        $ticket = $this->repo->findOrFailWithReplies($ticket);
        return view("Ticket::show", compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        //
    }

    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    public function reply(ReplyRequest $request, $id)
    {

        $ticket = $this->repo->findById($id);
        ReplyService::store($ticket, $request->body, $request->file("attachment"));
        newFeedback();
        return redirect()->route('tickets.show', $id);
    }

    public function reject(Request $request, $id)
    {
        $this->repo->setStatus($id, Ticket::STATUS_CLOSE);
        newFeedback();
        return redirect()->route('tickets.index');
    }

    public function destroy($id)
    {
        $ticket = $this->repo->findById($id);

        $hasAttachment = Reply::query()->where("ticket_id", $id)
            ->whereNotNull("media_id")
            ->with("media")
            ->get();

        foreach ($hasAttachment as $reply) {
            $reply->media->delete();
        }

        $ticket->delete();

        newFeedback();
        return redirect()->route('tickets.index');

    }
}
