<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;

use App\User;

use Validator;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $current = User::where('user_type', 1)->first();

        return view('admin.profile.edit')
        ->with('current', $current);

    }

    public function update(Request $request)
    {
    	$admin = User::where('user_type', 1)->first();
        if($request->username != $admin->username && $request->email != $admin->email)
        {
            $validation = Validator::make($request->all(),
            [
                'username' => 'required|unique:users,username',
                'email'    => 'required|unique:users,email|email',
            ]);
        }
        else
        {
            $validation = Validator::make($request->all(),
            [
                'username' => 'required',
                'email'    => 'required',
            ]);
        }

        if($validation->passes())
        {

            $admin->username = $request->username;
            $admin->username_tag = $this->trimString($request->username);
        	$admin->email = $request->email;
        	$admin->password = ($request->password) ? bcrypt($request->password) : $admin->password ;
        	$admin->password_secondary = ($request->password_secondary) ? bcrypt($request->password_secondary) : $admin->password_secondary ;
            $admin->save();


            return response()->json([
                'message'        => 'Admin saved Successfully',
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
