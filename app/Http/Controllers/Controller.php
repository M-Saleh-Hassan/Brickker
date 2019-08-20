<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use App\Models\Setting;
use App\Models\UserType;
use App\Models\Country;
use App\Models\Currency;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $user;
    private $signed_in;
    
    public function __construct()
    {
        $setting = Setting::first();
        view()->share('setting', $setting);
        
        $countries = Country::orderBy('title_en')->get();
        view()->share('countries', $countries);
        
        $active_currency = Currency::where('active',1)->first();
        view()->share('active_currency', $active_currency);
        
        $user_types = new UserType;
        $user_types = $user_types->getAvailableTypes();
        view()->share('user_types', $user_types);
        
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            $this->signed_in = Auth::check();

            view()->share('signed_in', $this->signed_in);
            view()->share('user', $this->user);

            return $next($request);
        });

    }

    protected function trimString($string)
    {
        $string = strtolower($string);
        //Make alphanumeric (removes all other characters)
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //Clean up multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);
        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string;
    }

}
