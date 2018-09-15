<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class NotificationRepository
{
    /**
     * Store image.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Image $image
     * @return void
     */
    public function deleteDuplicate($user, $image)
    {
        DB::table('notifications')
            ->whereNotifiableId($image->user->id)
            ->whereNull('read_at')
            ->where('data->image_id', $image->id)
            ->where('data->user', $user->id)
            ->delete();
    }
}