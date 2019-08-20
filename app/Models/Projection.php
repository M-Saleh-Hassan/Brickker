<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Projection extends Model
{
    protected $table = 'project_projections';
    
    public function project()
    {
        return $this->belongsTo('App\Models\Flat', 'project_id');
    }
    
}
