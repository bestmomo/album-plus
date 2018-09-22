<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Album repository.
     *
     * @var \App\Repositories\UserRepository
     */
    protected $repository;

    /**
     * Create a new UserController instance.
     *
     * @param  \App\Repositories\UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;

        $this->middleware('ajax')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->repository->getAllWithPhotosCount();

        return view ('users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view ('users.edit', compact ('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $this->repository->update ($user, $request);

        return redirect ()->route('user.index')->with ('ok', __ ("L'utilisateur a bien été modifié"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete ();

        return response ()->json ();
    }
}
