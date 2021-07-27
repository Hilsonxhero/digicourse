<?php

namespace Ticket\Observers;

use Ticket\Models\Reply;

class ReplyObserver
{

    public function created(Reply $reply)
    {
        //
    }


    public function updated(Reply $reply)
    {
        //
    }

    public function deleted(Reply $reply)
    {
        dd($reply);
    }

    public function restored(Reply $reply)
    {
        //
    }


    public function forceDeleted(Reply $reply)
    {
        //
    }
}
