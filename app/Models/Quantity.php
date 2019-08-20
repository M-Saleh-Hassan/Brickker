<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quantity extends Model
{
    protected $table = 'quantities';

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'main_product_id');
    }
    
    public function subProducts()
    {
        return $this->hasMany('App\Models\QuantityAdditional', 'quantity_id');
    }
    
    public function consultant()
    {
        return $this->belongsTo('App\User', 'consultant_id');
    }


}
