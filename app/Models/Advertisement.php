<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Media;

class Advertisement extends Model
{
    public function media()
    {
        // return $this->belongsTo('App\Models\Media', 'image');
        return Media::find($this->image);
    }

}
