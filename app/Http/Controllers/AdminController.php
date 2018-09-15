<?php

namespace App\Http\Controllers;

use App\Repositories\ImageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpFoundation\IpUtils;
use Illuminate\Contracts\Foundation\Application;

class AdminController extends Controller
{
    /**
     * Image repository.
     *
     * @var \App\Repositories\ImageRepository
     */
    protected $repository;

    /**
     * Create a new AdminController instance.
     *
     * @param  \App\Repositories\ImageRepository $repository
     */
    public function __construct(ImageRepository $repository)
    {
        $this->repository = $repository;

        $this->middleware('ajax')->only('destroy');
    }

    /**
     * Display a listing of the orphans.
     *
     * @return \Illuminate\Http\Response
     */
    public function orphans()
    {
        $orphans = $this->repository->getOrphans ();
        $orphans->count = count($orphans);

        return view ('maintenance.orphans', compact ('orphans'));
    }

    /**
     * Remove orphans from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $this->repository->destroyOrphans ();

        return response ()->json ();
    }

    /**
     * Maintenance mode.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Application $app)
    {
        $maintenance = $app->isDownForMaintenance();
        $ipChecked = true;
        $ip = $request->ip();

        if($maintenance) {
            $data = json_decode(file_get_contents($app->storagePath().'/framework/down'), true);
            $ipChecked = isset($data['allowed']) && IpUtils::checkIp($ip, (array) $data['allowed']);
        }

        return view ('maintenance.maintenance', compact ('maintenance', 'ip', 'ipChecked'));
    }

    /**
     * Update maintenance mode.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->maintenance) {
            Artisan::call ('down', $request->ip ? ['--allow' => $request->ip()] : []);
        } else {
            Artisan::call ('up');
        }

        return redirect()->route('maintenance.index')->with ('ok', __ ('Le mode a bien été actualisé.'));
    }
}
