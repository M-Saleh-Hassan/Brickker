<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class LangController extends Controller
{
    public function changeLanguage(Request $request, $lang)
    {
        $url = "";
        $current = url()->previous();
        
        if ($lang == "en") {
            $request->session()->put('lang', 'en');
            $url = str_replace("/ar", "/en", $current);
            // if(Auth::check())
            // {
            //     $user_id = Auth::user()->id;
            //     $user = User::find($user_id);
            //     $user->lang = 1;
            //     $user->save();
            // }
            
        }
        elseif ($lang == "ar") {
            $request->session()->put('lang', 'ar');
            $url = str_replace("/en", "/ar", $current);
            // if(Auth::check())
            // {
            //     $user_id = Auth::user()->id;
            //     $user = User::find($user_id);
            //     $user->lang = 2;
            //     $user->save();
            // }

        }
        
        return redirect($url);
    }
}
