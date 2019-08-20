<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Floor extends Model
{
    protected $table = 'project_floors';

    public function project()
    {
        return $this->belongsTo('App\Models\Flat', 'project_id');
    }
    
}
