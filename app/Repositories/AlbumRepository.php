<?php
/**
 * Created by PhpStorm.
 * User: Maurice
 * Date: 25/08/2018
 * Time: 21:53
 */

namespace App\Repositories;

use App\Models\Album;

class AlbumRepository extends BaseRepository
{
    /**
     * Create a new AlbumRepository instance.
     *
     * @param  \App\Models\Album $album
     */
    public function __construct(Album $album)
    {
        $this->model = $album;
    }

    /**
     * Create a new album.
     *
     * @param  \App\Models\User  $user
     * @param  array  $inputs
     * @return void
     */
    public function create($user, array $inputs)
    {
        $user->albums ()->create($inputs);
    }

    /**
     * Get albums for user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Support\Collection
     */
    public function getAlbums($user)
    {
        return $user->albums()->get();
    }

    /**
     * Get albums for user with images.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Support\Collection
     */
    public function getAlbumsWithImages($user)
    {
        return $user->albums()->with('images')->get();
    }
}