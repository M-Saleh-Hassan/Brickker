<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\UserType;
use App\Models\Offer;

class ScaleStep extends Model
{
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'scale_step_categories', 'scale_step_id', 'category_id')->withTimeStamps();
    }
    
    public function scales()
    {
        return $this->belongsToMany('App\Models\Scale', 'scale_scale_steps', 'scale_step_id', 'scale_id')->withTimeStamps();
    }
    
    public function userTypes()
    {
        return $this->belongsToMany('App\Models\UserType', 'scale_step_user_types', 'scale_step_id', 'user_type_id')->withTimeStamps();
    }
    
    /* Get Users which has category and user type of this step */
    public function users()
    {
        $categories      = $this->categories;
        $available_types = $this->userTypes;
        // return json_decode($available_types);
        
        $users = [];
        foreach($categories as $category)
        {
            foreach($category->users as $user)
            {
                if(!$available_types->whereIn('id', $user->userType)->isEmpty()) $users[] = $user;
            }
        }
        
        $collection = collect($users);
        return $collection->unique('id');
    }
    
    public function getOffers($subscription_id, $user_id)
    {
        return Offer::where([
            ['subscription_id', $subscription_id],
            ['step_id', $this->id],
            ['from_user', $user_id]
        ])->get();
    }
}
