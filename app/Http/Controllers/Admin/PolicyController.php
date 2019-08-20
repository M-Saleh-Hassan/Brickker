<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Policy;

use Validator;

class PolicyController extends Controller
{
    public function index()
    {
        $policy = Policy::find(1);
        
        return view('admin.policy.index')
        ->with('policy', $policy);
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            'content_en' => 'required',
            'content_ar'  => 'required'
        ]);
        
        if($validation->passes())
        {
            $policy = Policy::find(1);
            $policy->content_en = $request->policy_text_en;
            $policy->content_ar = $request->policy_text_ar;
            $policy->save();


            return response()->json([
                'message'        => 'Policy saved Successfully',
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
