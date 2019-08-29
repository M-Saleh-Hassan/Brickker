<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\UserType;
use App\Models\Product;
use App\Models\Offer;
use App\Models\Review;
use App\Models\Message;

class User extends Authenticatable
{
    use Notifiable;

    static $switch_password_field = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'password_secondary', 'remember_token',
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'user_categories', 'user_id', 'category_id')->withTimeStamps();
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }

    public function subscriptions()
    {
        return $this->hasMany('App\Models\Subscription');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function favorites()
    {
        return $this->hasMany('App\Models\Favorite');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification', 'to_user')->orderBy('created_at', 'DESC');
    }

    public function notificationsCount()
    {
        return $this->notifications()->where('seen', 0)->count();
    }

    public function sentMessages()
    {
        return $this->hasMany('App\Models\Message', 'from_user');
    }

    public function chatUsers()
    {
        $users = [];
        $messages = Message::where('from_user', $this->id)->orWhere('to_user', $this->id)->get();

        foreach($messages as $message)
        {
            if(!in_array($message->from, $users) && $message->from->id != $this->id){
                $users[]=$message->from;
            }
            if(!in_array($message->to, $users) && $message->to->id != $this->id){
                $users[]=$message->to;
            }
        }

        return $users;
    }

    public function getUserMessages($id)
    {
        $messages = Message::
        where([
            ['from_user', $this->id],
            ['to_user', $id]
        ])
        ->orWhere([
            ['from_user', $id],
            ['to_user', $this->id]
        ])->get();

        return $messages;
    }

    // public function scales()
    // {
    //     return $this->belongsToMany('App\Models\Scale', 'scale_user', 'user_id', 'scale_id')->withPivot('id', 'has_consultant', 'consultant_id', 'identifier')->withTimeStamps();
    // }

    public function providerOffers()
    {
        return $this->hasMany('App\Models\Offer', 'to_user');
    }

    public function filteredProducts($categories_id, $low_price, $high_price)
    {
        if($categories_id == 0)return Product::selectRaw('*,price-price*discount/100 as real_price')->where('user_id', $this->id)->having('real_price', '>', $low_price)->having('real_price', '<', $high_price)->get();
        return Product::selectRaw('*,price-price*discount/100 as real_price')->where('user_id', $this->id)->whereIn('category_id', $categories_id)->having('real_price', '>', $low_price)->having('real_price', '<', $high_price)->get();
    }

    public function userType()
    {
        return $this->belongsTo('App\Models\UserType', 'user_type');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }

    public function getProductReview($product_id)
    {
        $review = Review::where('product_id', $product_id)->where('user_id', $this->id)->first();
        if(!empty($review)) return $review->rate;
        else return 0;
    }

    public function getUsername()
    {
        $username = $this->username;
        //Lower case everything
        $username = strtolower($username);
        //Make alphanumeric (removes all other characters)
        $username = preg_replace("/[^a-z0-9_\s-]/", "", $username);
        //Clean up multiple dashes or whitespaces
        $username = preg_replace("/[\s-]+/", " ", $username);
        //Convert whitespaces and underscore to dash
        $username = preg_replace("/[\s_]/", "-", $username);
        return $username;
    }

    public function getUserType()
    {
        if($this->userType) return $this->userType->type;
        return null;
    }

    public function getUserTypeCategories()
    {
        return $this->userType->categories;
    }

    public function getProviderPhone($provider_id)
    {
        $count =  Offer::where([
            ['from_user', $this->id],
            ['to_user', $provider_id],
            ['status', 1]
        ])->get()->count();

        if(!$count) return 'hidden';
        return User::find($provider_id)->phone;
    }

    public function getProductOrServiceType()
    {
        if($this->userType->type == 'manufacturer' || $this->userType->type == 'supplier') return 'Product';
        else return 'Service';

    }

    public function getProductOrServiceTypeAr()
    {
        if($this->userType->type == 'manufacturer' || $this->userType->type == 'supplier') return 'منتج';
        else return 'خدمة';

    }

    public function getProductsOrServicesTypeAr()
    {
        if($this->userType->type == 'manufacturer' || $this->userType->type == 'supplier') return 'منتجات';
        else return 'خدمات';

    }


}
