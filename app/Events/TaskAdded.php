<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TaskAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $task;
    public $filePath;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $task)
    {
        $this->task = $task;
        $this->user = $task->developer_id;
        if ($task->get_image->first()) {
            $this->filePath = $task->get_image->first()->file_path;
        } else {
            $this->filePath = null;
        }
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
            'filePath' => $this->filePath,
        ];
    }
}
