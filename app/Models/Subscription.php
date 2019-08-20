<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'user_subscriptions';
    protected $appends = ['total_price'];

    public function getTotalPriceAttribute()
    {
        $total_price = 0;
        foreach($this->offers as $offer) $total_price+= $offer->total_price;
        return $total_price;
    }

    public function scale()
    {
        return $this->belongsTo('App\Models\Scale');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function consultant()
    {
        // has error
        return $this->belongsTo('App\User', 'consultant_id')->where('user_subscriptions.has_consultant', 0);
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer', 'subscription_id');
    }
    
    public function projects()
    {
        return $this->belongsToMany('App\Models\Project', 'project_subscription', 'subscription_id', 'project_id')->withTimestamps();
    }

    public function getProjectName()
    {
        return ($this->projects->Count()) ?  $this->projects()->first()->title : 'Not Assigned' ;
    }
    
    public function getProject()
    {
        return ($this->projects->Count()) ?  $this->projects()->first() : [] ;
    }
    
}
