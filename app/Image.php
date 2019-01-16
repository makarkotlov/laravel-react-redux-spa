<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file_path',
        'task_id',
        'created_at',
        'updated_at',
        'sender_id',
        'type',
    ];

    public function get_task()
    {
        return $this->belongsTo('App\Task', 'task_id', 'id');
    }
}
