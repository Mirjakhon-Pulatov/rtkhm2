<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
{
    /**
     * Create a new policy instance.
     */
    use HandlesAuthorization;

    public function viewMenu(User $user)
    {
        return $user->role === 'admin';
    }
}
