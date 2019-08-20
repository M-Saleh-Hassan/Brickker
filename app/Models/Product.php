<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Favorite;

class Product extends Model
{
    protected $table = 'user_products';
    protected $appends = ['current_price', 'total_price', 'average_rating'];
    
    public function getCurrentPriceAttribute()
    {
        return $this->price-$this->price*$this->discount/100;
    }

    public function getTotalPriceAttribute()
    {
        return $this->additionalProductsData()->sum('price');
    }

    public function getAverageRatingAttribute()
    {
        if(!$this->reviews()->count()) return 0; //Handling division by zero
        return round(($this->reviews()->sum('rate') / $this->reviews()->count()), 1);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    
    public function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }
    
    public function images()
    {
        return $this->hasMany('App\Models\ProductImage', 'product_id');
    }
    
    public function reviews()
    {
        return $this->hasMany('App\Models\Review', 'product_id');
    }
    
    public function ads()
    {
        return $this->hasMany('App\Models\Advertisement', 'product_id');
    }
    
    public function getRecommendedPercentage()
    {
        if(!$this->reviews()->count()) return 0; //Handling division by zero
        return (int)($this->reviews()->where('recommend', 1)->count() / $this->reviews()->count() * 100) ;
    }
    
    public function getStarsPercentage($stars_count)
    {
        if(!$this->reviews()->count()) return 0; //Handling division by zero
        return ( int )( $this->reviews()->where('rate', $stars_count)->count() / $this->reviews()->count() * 100);
    }
    
    public function getStarsCount($stars_count)
    {
        return $this->reviews()->where('rate', $stars_count)->count();
    }
    
    public function additionalProducts()
    {
        return $this->hasMany('App\Models\ProductAdditional', 'parent_product_id');
    }

    public function quantity()
    {
        return $this->hasMany('App\Models\Quantity', 'main_product_id');
    }
    
    public function quantitySubProducts()
    {
        if(empty($this->quantity()->where('accepted', 1)->first())) return [];
        return $this->quantity()->where('accepted', 1)->first()->subProducts;
    }
    
    public function additionalProductsData()
    {
        return $this->belongsToMany('App\Models\Product', 'user_products_additional', 'parent_product_id', 'child_product_id');    
    }
    
    public function getProductsWithAdditional()
    {
        // SELECT a.*,a.price-a.price*a.discount/100 AS real_price , SUM(c.price-c.price*c.discount/100) AS total_price, COUNT(c.id) AS products_count
        // FROM user_products as a
        // INNER JOIN user_products_additional as b
        // ON a.id = b.parent_product_id
        // INNER JOIN user_products as c
        // ON c.id = b.child_product_id
        // GROUP BY b.parent_product_id
        // HAVING a.id IN (18) ,  'a.price-a.price*a.discount/100 AS real_price' , 'SUM(c.price-c.price*c.discount/100) AS total_price', 'COUNT(c.id) AS products_count'
        return DB::table('user_products as a')
            ->join('user_products_additional as b', 'a.id', '=', 'b.parent_product_id')
            ->join('user_products as c', 'c.id', '=', 'b.child_product_id')
            ->select('a.*', DB::raw('a.price-a.price*a.discount/100 AS real_price'), DB::raw('SUM(c.price-c.price*c.discount/100) AS total_price'), DB::raw('COUNT(c.id) AS products_count'))
            ->groupBy('b.parent_product_id')
            ->having('a.id', '=', 18)
            ->get();
    }
    
    public function getadditionalProductsTags()
    {
        $products_tags = "";
        
        foreach($this->additionalProducts as $product) $products_tags .= $product->childProduct->title_tag . ',';
        $products_tags = rtrim($products_tags, ',');
        
        return $products_tags;
    }
    
    public function getRelatedProducts()
    {
        if(empty($this->user->userType->users)) return [];
        if(empty($this->category->products)) return [];
        $users_id = $this->user->userType->users()->select('id')->get();
        return $this->category->products()->whereIn('user_id', $users_id)->where('id', '<>', $this->id)->get();
    }
    
    public function getFavoriteClass($user_id = null)
    {
        return (!empty( Favorite::where('user_id',$user_id)->where('product_id', $this->id)->first() ) ) ? 'fa fa-heart' : 'fa fa-heart-o';
    }

    
}
