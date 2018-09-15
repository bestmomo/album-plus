<?php

namespace App\Http\Controllers;

use Illuminate\ {
    Http\Request,
    Notifications\DatabaseNotification
};

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        return view('notifications.index', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Notifications\DatabaseNotification $notification
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, DatabaseNotification $notification)
    {
        $notification->markAsRead();

        if($request->user()->unreadNotifications->isEmpty()) {
            return redirect()->route('home');
        }

        return back();
    }
}
