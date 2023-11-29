<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function viewAny(User $user)
    {
        return $user->isAdmin() || $user->isModerator();
    }

    public function update(User $user)
    {
        return $user->isAdmin() || $user->isModerator();
    }

    public function delete(User $user)
    {
        return $user->isAdmin() || $user->isModerator();
    }
}
