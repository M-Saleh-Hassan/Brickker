<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Project extends Model
{

    public function flats()
    {
        return $this->hasMany('App\Models\Flat', 'project_id');
    }
    
    public function rooms()
    {
        return $this->hasMany('App\Models\Room', 'project_id');
    }
    
    public function floors()
    {
        return $this->hasMany('App\Models\Floor', 'project_id');
    }
    
    public function projections()
    {
        return $this->hasMany('App\Models\Projection', 'project_id');
    }
    
    public function subscriptions()
    {
        return $this->belongsToMany('App\Models\Subscription', 'project_subscription', 'project_id', 'subscription_id')->withTimestamps();
    }
}
