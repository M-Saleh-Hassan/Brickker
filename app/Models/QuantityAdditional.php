<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuantityAdditional extends Model
{
    protected $table = 'quantities_additional';

    public function quantity()
    {
        return $this->belongsTo('App\Models\Quantity', 'quantity_id');
    }
    
    public function subProduct()
    {
        return $this->belongsTo('App\Models\Product', 'sub_product_id');
    }
    
}
