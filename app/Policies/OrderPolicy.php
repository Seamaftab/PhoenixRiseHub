<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user)
    {
        return $user->isAdmin() || $user->isModerator();
    }

    public function update(User $user, Order $order)
    {
        return $user->isAdmin() || $user->isModerator();
    }

    public function delete(User $user, Order $order)
    {
        return $user->isAdmin() || $user->isModerator();
    }
}
