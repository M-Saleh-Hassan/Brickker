<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Unit extends Model
{
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

}