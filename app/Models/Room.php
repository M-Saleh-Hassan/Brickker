<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Room extends Model
{
    protected $table = 'project_rooms';

    public function project()
    {
        return $this->belongsTo('App\Models\Flat', 'project_id');
    }
    
}
