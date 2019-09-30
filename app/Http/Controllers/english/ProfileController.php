<?php

namespace App\Http\Controllers\english;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;
use App\User;
use App\Models\Category;
use App\Models\UserType;
use App\Models\Unit;

class ProfileController extends Controller
{
    public function index()
    {
        $categories = new Category;
        $subcategories = $categories->getAllSubCategories();
        $parentcategories = $categories->getAllParentCategories();
        $user_types = UserType::where('type', '<>', 'admin')->get();
        $units      = Unit::all();

        if(Auth::user()->getUserType() == 'customer') return view('tashtebk.english.user.profile.customer')->with('active', 'profile');

        return view('tashtebk.english.user.profile.index')
        ->with('subcategories', $subcategories)
        ->with('parentcategories', $parentcategories)
        ->with('user_types', $user_types)
        ->with('units', $units)
        ->with('active', 'profile');
    }

    public function show($username_tag)
    {
        $user = User::where('username_tag', $username_tag)->first();

        return view('tashtebk.english.user.profile.show')
        ->with('user', $user);
    }

    public function update(Request $request, $username_tag)
    {
        $user = User::where('username_tag', $username_tag)->first();

        $rules= [
            'real_name' => 'required',
            'phone' => 'required',
            'country' => 'required',
        ];

        $messages = [
            'required'    => 'The :attribute field is required',
        ];

        if(request()->hasFile('avatar'))$rules['avatar'] = 'required|mimes:jpeg,bmp,png,jpg|max:500';
        if($request->username != $user->username) $rules['username'] = 'required|unique:users,username';
        if($request->email != $user->email) $rules['email'] = 'required|unique:users,email|email';

        $this->validate($request, $rules, $messages);

        if($request->has('user_categories'))
        {
            /* Delete Old categories */
            foreach($user->categories as $category)
            {
                $user->categories()->detach($category);
            }

            /* Add New Categories */
            foreach($request->user_categories as $category)
            {
                $user->categories()->attach($category);
            }
        }

        $user->username = $request->username;
        $user->username_tag = $this->trimString($request->username);
        $user->real_name = $request->real_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->country_id = $request->country;
        $user->bio = $request->bio;
        $user->short_title = $request->short_title;
        $user->company_name = $request->company_name;

        //avatar
        if(request()->hasFile('avatar'))
        {
            $file=$request['avatar'];
            $name = $file->getClientOriginalName();
            $name = str_replace(' ', '_', $name);
            $request->file('avatar')->move('tashtebk/images/avatars/', $name);
            $user->avatar='tashtebk/images/avatars/'.$name;
        }
        $user->save();

        return redirect()->route('en.profile.index', ['username_tag' => $user->username_tag])->with('success', 'Profile Updated Successfully');
    }

    public function settype(Request $request, $username_tag)
    {
        $user = User::where('username_tag', $username_tag)->first();
        $user->user_type = $request->user_type;
        $user->save();
        return response()->json(array('redirect' => route('en.profile.index', [$username_tag])), 200);
    }

    public function changeType(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->user_type = NULL;
        $user->save();

        foreach($user->products as $product)
        {
            $product->delete();
        }
        foreach($user->projects as $project)
        {
            $project->delete();
        }
        foreach($user->subscriptions as $subscription)
        {
            $subscription->delete();
        }
        foreach($user->orders as $order)
        {
            $order->delete();
        }
        foreach($user->favorites as $favorite)
        {
            $favorite->delete();
        }

        return response()->json(array('redirect' => route('en.profile.index', [Auth::user()->username_tag])), 200);
    }

    public function deactivate()
    {
        $user = User::find(Auth::user()->id);
        $user->deactivate = 1;
        $user->save();

        Auth::logout();
        return response()->json(array('redirect' => route('en.home.index')), 200);

    }

    public function delete()
    {
        $user = User::find(Auth::user()->id);
        $user->delete();

        Auth::logout();
        return response()->json(array('redirect' => route('en.home.index')), 200);

    }

    public function filter(Request $request)
    {
        $user_types_profiles_filter_ids = $request->user_types_profiles_filter;

        $user_types = new UserType;
        $user_types = (empty($user_types_profiles_filter_ids)) ? $user_types->getAvailableTypes() : $user_types->getAvailableFilteredTypes($user_types_profiles_filter_ids);

        $profile_html = view('tashtebk.english.user.filter_profiles')
        ->with('user_types',$user_types)
        ->render();

        return response()->json(array('result' => $profile_html), 200);
    }
}
