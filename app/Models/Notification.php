<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $appends = ['message_en', 'message_ar'];
    
    public function getMessageEnAttribute()
    {
        if($this->type->type == 'offer')
        {
            if($this->from->getUserType() == 'customer')
            {
                $message = "You get a new offer on your ";
                $message .= ($this->to->getUserType() == 'consultant' || $this->to->getUserType() == 'supplier') ? 'product ' : 'service ';
                $message .= $this->product->title . ' from ' . $this->from->real_name;
            }
            else
            {
                $message = "Your offer on ";
                $message .= ($this->from->getUserType() == 'consultant' || $this->from->getUserType() == 'supplier') ? 'product ' : 'service ';
                $message .= $this->product->title . ' from ' . $this->from->real_name;
                $message .= ' has been ';
                $message .= ($this->status) ? 'accepted.' : 'refused.';
            }
        }
        elseif($this->type->type == 'order')
        {
            if($this->from->getUserType() == 'customer')
            {
                $message = "You get a new order on your ";
                $message .= ($this->to->getUserType() == 'consultant' || $this->to->getUserType() == 'supplier') ? 'product ' : 'service ';
                $message .= $this->product->title . ' from ' . $this->from->real_name;
            }
            else
            {
                $message = "Your order on ";
                $message .= ($this->from->getUserType() == 'consultant' || $this->from->getUserType() == 'supplier') ? 'product ' : 'service ';
                $message .= $this->product->title . ' to ' . $this->from->real_name;
                $message .= ' has been ';
                $message .= ($this->status) ? 'accepted.' : 'refused.';
            }
        }
        
        return $message;
    }
    
    public function getMessageArAttribute()
    {
        if($this->type->type == 'offer')
        {
            if($this->from->getUserType() == 'customer')
            {
                $message = "لديك عرض جديد على  ";
                $message .= ($this->to->getUserType() == 'consultant' || $this->to->getUserType() == 'supplier') ? 'منتجك ' : 'خدمتك  ';
                $message .= $this->product->title . ' من ' . $this->from->real_name;
            }
            else
            {
                $message = "عرضك على ";
                $message .= ($this->from->getUserType() == 'consultant' || $this->from->getUserType() == 'supplier') ? 'منتج ' : 'خدمة ';
                $message .= $this->product->title . ' ل ' . $this->from->real_name;
                $message .= ' تم ';
                $message .= ($this->status) ? 'قبوله' : 'رفضه ';
            }
        }
        elseif($this->type->type == 'order')
        {
            if($this->from->getUserType() == 'customer')
            {
                $message = "لديك عرض جديد على  ";
                $message .= ($this->to->getUserType() == 'consultant' || $this->to->getUserType() == 'supplier') ? 'منتجك ' : 'خدمتك  ';
                $message .= $this->product->title . ' من ' . $this->from->real_name;
            }
            else
            {
                $message = "عرضك على ";
                $message .= ($this->from->getUserType() == 'consultant' || $this->from->getUserType() == 'supplier') ? 'منتج ' : 'خدمة ';
                $message .= $this->product->title . ' ل ' . $this->from->real_name;
                $message .= ' تم ';
                $message .= ($this->status) ? 'قبوله' : 'رفضه ';
            }
        }
        
        return $message;

    }

    public function type()
    {
        return $this->belongsTo('App\Models\NotificationType', 'type_id');
    }
    
    public function from()
    {
        return $this->belongsTo('App\User', 'from_user');
    }
    
    public function to()
    {
        return $this->belongsTo('App\User', 'to_user');
    }
    
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    
}
