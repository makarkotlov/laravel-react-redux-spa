<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'author_id',
        'is_urgent',
        'is_done',
        'developer_id',
        'additional_info',
        'done_by',
        'created_at',
        'updated_at',
        'feedback',
    ];

    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    public function get_developer()
    {
        return $this->belongsTo('App\User', 'developer_id');
    }

    public function get_image()
    {
        return $this->hasMany('App\Image', 'task_id', 'id');
    }
}
