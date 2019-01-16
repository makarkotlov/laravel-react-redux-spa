<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'created_at',
    ];

    public function get_users()
    {
        return $this->hasMany('App\User', 'department_id', 'id');
    }
}
