<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Media;

class Category extends Model
{
    protected $fillable = ['parent_id', 'title', 'show', 'order', 'home'];
    protected $table = 'categories';

    /**
     * The media that belong to the category.
     */
    public function media()
    {
        return $this->belongsToMany('App\Models\Media', 'categories_media', 'category_id', 'media_id')->withTimeStamps();
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_categories', 'category_id', 'user_id')->withTimeStamps();
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
    
    public function types()
    {
        return $this->belongsToMany('App\Models\UserType', 'categories_types', 'category_id', 'user_type_id')->withTimeStamps();
    }
    
    public function scaleSteps()
    {
        return $this->belongsToMany('App\Models\ScaleStep', 'scale_step_categories', 'category_id', 'scale_step_id')->withTimeStamps();
    }
    
    public function codes()
    {
        return $this->hasMany('App\Models\CategoryCode');
    }

    public function getImage()
    {
        $pivot = DB::table('categories_media')->select('media_id')->where('category_id', $this->id)->first();
        return Media::find($pivot->media_id);
    }

    public function getParent()
    {
        return $category = Category::find($this->parent_id);
    }

    public function getSubCategories($id)
    {
        $categories =  Category::where('parent_id',$id)->get();
        return ($categories->count() == 0 ) ? [] : $categories;
    }

    public function getCategoryProducts($title_tag)
    {
        $category =  Category::where('title_tag',$title_tag)->first();
        return $category->products;
    }
    
    public function getAllSubCategories()
    {
        return Category::where('parent_id', '<>', 'NULL')->get();
    }

    public function getAllParentCategories()
    {
        return Category::where('parent_id', '=', NULL)->get();
    }

    public function getParentCategoryProducts()
    {
        $subcategories = $this->getSubCategories($this->id);
        $products = [];
    
        foreach($subcategories as $category)
        {
            foreach($category->products as $product)
            {
                $products[] = $product;
            }
        }

        if(empty($products)) return $products;
        return $products;
    }

    public function getProviders()
    {
        $subcategories = $this->getSubCategories($this->id);
        $providers = [];

        foreach($subcategories as $category)
        {
            foreach($category->products as $product)
            {
                $providers[] = $product->user;
            }
        }

        if(empty($providers)) return $providers;
        return array_unique($providers);        
    }
}
