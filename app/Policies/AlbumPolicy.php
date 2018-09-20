<?php

namespace App\Policies;

use App\Models\ { User, Album };
use Illuminate\Auth\Access\HandlesAuthorization;

class AlbumPolicy
{
    use HandlesAuthorization;

    /**
     * Grant all abilities to administrator.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function before(User $user)
    {
        if ($user->admin) {
            return true;
        }
    }

    /**
     * Determine whether the user can manage the album.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Album $album
     * @return mixed
     */
    public function manage(User $user, Album $album)
    {
        return $user->id === $album->user_id;
    }
}
