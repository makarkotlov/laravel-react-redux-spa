<?php

namespace App\Listeners;
use App\Events\TaskDeleted;

class TSK
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  TaskDeleted  $event
     * @return void
     */
    public function handle(TaskDeleted $event)
    {
        //dd($event->task);
        //$event->task->delete();
    }
}
