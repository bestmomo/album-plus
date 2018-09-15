<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can manage his profile.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $userprofile
     * @return mixed
     */
    public function manage(User $user, User $userprofile)
    {
        return $user->id === $userprofile->id;
    }
}
