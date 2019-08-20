<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Media;

class UserType extends Model
{
    protected $fillable = ['type', 'privileges', 'media_id'];
    protected $table = 'users_types';
    
    public function getImage()
    {
        return $this->belongsTo('App\Models\Media', 'media_id');
    }
    
    public function getAvailableTypes()
    {
        return UserType::where('type', '<>', 'admin')->where('type', '<>', 'customer')->get();
    }
    
    public function getAvailableFilteredTypes($user_types_ids)
    {
        return UserType::where('type', '<>', 'admin')->where('type', '<>', 'customer')->whereIn('id', $user_types_ids)->get();
    }
    
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'categories_types', 'user_type_id', 'category_id')->withTimeStamps();
    }
    
    public function scaleSteps()
    {
        return $this->belongsToMany('App\Models\ScaleStep', 'scale_step_user_types', 'user_type_id', 'scale_step_id')->withTimeStamps();
    }

    public function users()
    {
        return $this->hasMany('App\User', 'user_type');
    }
    
    public function hasProducts()
    {
        foreach($this->users as $user)foreach($user->products as $product)return 1;
        return 0;
    }
    
    public function hasUsers()
    {
        return ($this->users()->count()) ? 1 : 0 ;    
    }
    public function hasProductsAtRange($low_price, $high_price)
    {
        foreach($this->users as $user)foreach($user->products()->selectRaw('*,price-price*discount/100 as real_price')->where('user_id', $user->id)->having('real_price', '>', $low_price)->having('real_price', '<', $high_price)->get() as $product)return 1;
        return 0;
    }
    
    public function hasProductsForCategory($category_title)
    {
        foreach($this->users as $user)foreach($user->products as $product)if($product->category->title == $category_title)return 1;
        return 0;
    }
    
    public function hasFilteredProducts($categories_ids, $low_price, $high_price)
    {
        foreach($this->users as $user)foreach($user->filteredProducts($categories_ids, $low_price, $high_price) as $product)return 1;
        return 0;
    }
    
    
    
}
