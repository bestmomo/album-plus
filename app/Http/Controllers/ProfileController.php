<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\ImageRepository;

class ProfileController extends Controller
{
    /**
     * Create a new ProfileController instance.
     *
     */
    public function __construct()
    {
        $this->middleware('ajax')->only('destroy');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize ('manage', $user);

        return view ('profiles.edit', compact ('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize ('manage', $user);

        $request->validate ([
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'pagination' => 'required',
        ]);

        $user->update ([
            'email' => $request->email,
            'settings' => json_encode ([
                'pagination' => (integer)$request->pagination,
                'adult' => $request->filled('adult'),
            ]),
        ]);

        return back ()->with ('ok', __ ('Le profil a bien été mis à jour'));
    }

    /**
     * Destroy the specified resource in storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize ('manage', $user);

        $user->delete();

        return response ()->json ();
    }

    /**
     * Show the specified resource in storage.
     *
     * @param  \App\Repositories\ImageRepository $imageRepository
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(ImageRepository $imageRepository, User $user)
    {
        $this->authorize ('manage', $user);

        $images = $imageRepository->getImagesForUser ($user->id);

        return view ('profiles.data', compact ('user', 'images'));
    }
}
