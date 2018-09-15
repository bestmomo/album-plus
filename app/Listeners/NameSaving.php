<?php

namespace App\Listeners;

use App\Events\NameSaving as EventNameSaving;

class NameSaving
{
    /**
     * Handle the event.
     *
     * @param EventNameSaving|object $event
     * @return void
     */
    public function handle(EventNameSaving $event)
    {
        $event->model->slug = str_slug($event->model->name, '-');
    }
}
