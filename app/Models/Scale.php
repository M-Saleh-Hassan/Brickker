<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\ScaleStep;
use App\Models\Scale;

class Scale extends Model
{
    public function scaleSteps()
    {
        return $this->belongsToMany('App\Models\ScaleStep', 'scale_scale_steps', 'scale_id', 'scale_step_id')->withTimeStamps();
    }
    
    public function orderedScaleSteps()
    {
        return $this->scaleSteps()->orderBy('scale_scale_steps.step_order', 'asc')->get();        
    }

    public function remainingScaleSteps()
    {
        $current =  $this->scaleSteps;
        $all = ScaleStep::all();
        $remaining = [];
        foreach($all as $all_step)
        {
            foreach($current as $current_step)
            {
                if($current_step->id == $all_step->id)continue 2;
            }
            $remaining [] = $all_step;
        }
        return $remaining;
    }

    public function image()
    {
        return $this->belongsTo('App\Models\Media', 'media_id');
    }

    public function subscriptions()
    {
        return $this->hasMany('App\Models\Subscription');
    }

    // public function users()
    // {
    //     return $this->belongsToMany('App\User', 'scale_user', 'scale_id', 'user_id')->withPivot('id', 'has_consultant', 'consultant_id', 'identifier')->withTimeStamps();
    // }


}
