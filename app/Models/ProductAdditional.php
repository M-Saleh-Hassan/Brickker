<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAdditional extends Model
{
    protected $table = 'user_products_additional';

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'parent_product_id');
    }
    
    public function childProduct()
    {
        return $this->belongsTo('App\Models\Product', 'child_product_id');
    }


}
