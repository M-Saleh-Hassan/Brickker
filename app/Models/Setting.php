<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Media;

class Setting extends Model
{
    protected $fillable = ['website_title', 'logo', 'fav_icon', 'mobile1', 'mobile2', 'mobile1', 'email', 'fb', 'fb_show'];

    public function getLogo()
    {
        return Media::find($this->logo);
    }    

    public function getFav()
    {
        return Media::find($this->fav_icon);
    }    
}
