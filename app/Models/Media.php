<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['original_name', 'size', 'link', 'type', 'preview_link'];
    protected $table = 'media';

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'categories_media', 'media_id', 'category_id')->withTimeStamps();
    }


}
