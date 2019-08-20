<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Howtowork extends Model
{
    protected $table = 'howtowork';
    
    public function image()
    {
        return $this->belongsTo('App\Models\Media', 'image_id');
    }

}
