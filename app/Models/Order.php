<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $appends = ['total_price'];

    public function getTotalPriceAttribute()
    {
        return $this->product->current_price * $this->quantity;
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

}
