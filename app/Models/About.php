<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Media;

class About extends Model
{
    protected $fillable = ['vision_text', 'vision_image', 'mission_text', 'mission_image', 'why_us_image'];
    protected $table = 'about';
    
    public function getVisionImage()
    {
        return Media::find($this->vision_image);
    }
    
    public function getMissionImage()
    {
        return Media::find($this->mission_image);
    }
    
    public function getWhyUsImage()
    {
        return Media::find($this->why_us_image);
    }
}
