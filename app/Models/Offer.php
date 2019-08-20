<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $appends = ['total_price'];

    public function getTotalPriceAttribute()
    {
        return $this->product->current_price * $this->quantity;
    }

    public function subscription()
    {
        return $this->belongsTo('App\Models\Subscription', 'subscription_id');
    }

    public function step()
    {
        return $this->belongsTo('App\Models\ScaleStep', 'step_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\User', 'from_user');
    }

    public function provider()
    {
        return $this->belongsTo('App\User', 'to_user');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    
    public function floor()
    {
        return $this->belongsTo('App\Models\Floor');
    }
    
    public function flat()
    {
        return $this->belongsTo('App\Models\Flat');
    }
    
    public function room()
    {
        return $this->belongsTo('App\Models\Room');
    }
    
    public function projection()
    {
        return $this->belongsTo('App\Models\Projection');
    }
    
    public function getStatus()
    {
        if($this->status == 0 ) return '<a class="fa fa-hourglass" title="pending"></a>';
        elseif($this->status == 1 ) return '<a class="fa fa-check" title="accepted"></a>';
        elseif($this->status == -1 ) return '<a class="fa fa-close" title="rejected"></a>';
    }

}
