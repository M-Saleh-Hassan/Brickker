<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Media;

use Validator;

class SettingsController extends Controller
{
    public function index()
    {
        $media = Media::all();
        $settings = Setting::first();
        return view('admin.settings.index')
        ->with('current', $settings)
        ->with('media', $media);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(),
        [
            'website_title' => 'required|max:51|min:3',
            'mobile1' => 'required|numeric',
            'mobile2' => 'required|numeric',
            'email' => 'required|email',
            'logo' => 'required',
            'fav_icon' => 'required',
        ]);
        if($validation->passes())
        {
            
            $website_title = $request->website_title;
            $mobile1  = $request->mobile1;
            $mobile2  = $request->mobile2;
            $email    = $request->email;
            $logo     = $request->logo;
            $fav_icon = $request->fav_icon;
            $fb       = $request->fb;
            $youtube  = $request->youtube;
            $twitter  = $request->twitter;
            $insta    = $request->insta;
            $fb_show  = ($request->fb_show == '1') ? 1 : 0;
            $youtube_show = ($request->youtube_show == '1') ? 1 : 0;
            $twitter_show = ($request->twitter_show == '1') ? 1 : 0;
            $insta_show   = ($request->insta_show == '1') ? 1 : 0;
            $setting =  Setting::find($id);
            $setting->website_title = $website_title;
            $setting->mobile1       = $mobile1;
            $setting->mobile2       = $mobile2;
            $setting->email         = $email;
            $setting->logo          = $logo;
            $setting->fav_icon      = $fav_icon;
            $setting->fb            = $fb;
            $setting->youtube       = $youtube;
            $setting->twitter        = $twitter;
            $setting->insta         = $insta;
            $setting->fb_show       = $fb_show;
            $setting->youtube_show  = $youtube_show;
            $setting->twitter_show   = $twitter_show;
            $setting->insta_show    = $insta_show;
            $setting->save();
            
            return response()->json([
                'message'        => 'Settings saved Successfully',
                'errors'         => '',
            ]);
        }
        else
        {
            return response()->json([
                'message' => '',
                'errors'  => $validation->errors()->all(),
            ]);
        }

    } 
}
