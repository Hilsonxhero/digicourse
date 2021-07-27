<?php

namespace Ticket\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use User\Models\User;

class ReplyPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }
}
