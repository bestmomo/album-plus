<?php
/**
 * Created by PhpStorm.
 * User: Maurice
 * Date: 25/08/2018
 * Time: 21:53
 */

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserRepository extends BaseRepository
{
    /**
     * Create a new UserRepository instance.
     *
     * @param  \App\Models\User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\User $user
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function update(User $user, Request $request)
    {
        if($user->hasVerifiedEmail() && !$request->verified) {
            $request->merge(['email_verified_at' => null]);
        }

        if(!$user->hasVerifiedEmail() && $request->verified) {
            $request->merge(['email_verified_at' => new Carbon]);
        }

        $user->adult = $request->adult;
        $user->update ($request->all());
    }

    /**
     * Get all users with photos number.
     *
     * @param  string
     * @return  Illuminate\Support\Collection
     */
    public function getAllWithPhotosCount()
    {
        return User::withCount('images')->oldest('name')->get();
    }

}