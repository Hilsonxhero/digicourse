<?php

namespace Payment\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use User\Models\User;

class PaymentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
