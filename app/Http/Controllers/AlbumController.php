<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Http\Requests\AlbumRequest;
use App\Repositories\AlbumRepository;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Album repository.
     *
     * @var \App\Repositories\AlbumRepository
     */
    protected $repository;

    /**
     * Create a new AlbumController instance.
     *
     * @param  \App\Repositories\AlbumRepository $repository
     */
    public function __construct(AlbumRepository $repository)
    {
        $this->repository = $repository;

        $this->middleware('ajax')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userAlbums = $this->repository->getAlbums ($request->user ());

        return view ('albums.index', compact('userAlbums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AlbumRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumRequest $request)
    {
        $this->repository->create ($request->user(), $request->all ());

        return redirect ()->route('album.index')->with ('ok', __ ("L'album a bien été enregistré"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        return view ('albums.edit', compact ('album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\AlbumRequest $request
     * @param \App\Models\Album
     * @return \Illuminate\Http\Response
     */
    public function update(AlbumRequest $request, Album $album)
    {
        $this->authorize('manage', $album);

        $album->update ($request->all ());

        return redirect ()->route('album.index')->with ('ok', __ ("L'album a bien été modifié"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        $this->authorize('manage', $album);

        $album->delete ();

        return response ()->json ();
    }
}
