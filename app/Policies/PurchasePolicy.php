<?php

namespace App\Policies;

use App\Models\PurchaseRequest;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PurchasePolicy
{

    public function viewAny(User $user)
    {
        return $user->isAdmin() || $user->isModerator();
    }

    public function view(User $user)
    {
        return $user->isAdmin() || $user->isModerator();
    }

    public function create(User $user)
    {
        return $user->isAdmin() || $user->isModerator();  
    }

    public function update(User $user)
    {
        return $user->isAdmin();
    }

    public function delete(User $user)
    {
        return $user->isAdmin();
    }

    // public function delete(User $user, PurchaseRequest $purchaseRequest)
    // {
    //     return $user->isAdmin();
    // }

}
