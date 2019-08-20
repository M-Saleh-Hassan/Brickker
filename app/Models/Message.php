<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Message extends Model
{
    public function from()
    {
        return $this->belongsTo('App\User', 'from_user');
    }
    
    public function to()
    {
        return $this->belongsTo('App\User', 'to_user');
    }


}
