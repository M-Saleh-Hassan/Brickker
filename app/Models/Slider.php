<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Media;
class Slider extends Model
{
    protected $fillable = ['title', 'media_id', 'text', 'slide_order'];
    protected $table = 'slider';

    public function media()
    {
        //return $this->hasOne('App\Models\Media');
        return Media::find($this->media_id);
    }

}
