<?php

namespace Ticket\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use User\Models\User;

class TicketPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }
}
