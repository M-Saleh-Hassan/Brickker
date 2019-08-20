<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewHelpful extends Model
{
    protected $table = 'reviews_helpful';
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function Review()
    {
        return $this->belongsTo('App\Models\Review');
    }

}
