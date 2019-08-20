<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    
    public function helpfulReviews()
    {
        return $this->hasMany('App\Models\ReviewHelpful');
    }
    
    public function getHelpful($helpful_value)
    {
        return $this->helpfulReviews()->where('helpful', $helpful_value)->count();
    }

}
