<?php

namespace App\Listeners;

use App\Events\TaskAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TaskAdded  $event
     * @return void
     */
    public function handle(TaskAdded $event)
    {
        //$event->task;
        
    }
}
