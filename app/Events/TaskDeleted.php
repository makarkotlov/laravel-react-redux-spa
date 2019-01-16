<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskDeleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $taskArray;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $taskArray)
    {
        $this->task = $taskArray;
        $this->user = $taskArray["developer_id"];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('employees');
    }
    
    public function broadcastWith()
    {
        return [
            'user' => $this->user,
            'task' => $this->task, //view('tasks.comments.single', ['i' => $this->comment])->render()
        ];
    }
}
