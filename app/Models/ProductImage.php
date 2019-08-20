<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductImage extends Model
{
    protected $table = 'user_products_images';
    
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

}
