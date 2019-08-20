<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\About;

use Validator;

class AboutController extends Controller
{
    public function index()
    {
        $media = Media::all();
        $about = About::first();
        
        return view('admin.about.index')
        ->with('media', $media)
        ->with('about', $about);
    }

    public function vision(Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            'vision_image' => 'required',
            'vision_text'  => 'required|min:10'
        ]);
        
        if($validation->passes())
        {
            $about = About::first();
            $about->vision_text  = $request->vision_text;
            $about->vision_image = $request->vision_image;
            $about->save();


            return response()->json([
                'message'        => 'Vision saved Successfully',
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

    public function mission(Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            'mission_image' => 'required',
            'mission_text'  => 'required|min:10'
        ]);
        
        if($validation->passes())
        {
            $about = About::first();
            $about->mission_text  = $request->mission_text;
            $about->mission_image = $request->mission_image;
            $about->save();


            return response()->json([
                'message'        => 'Mission saved Successfully',
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
    
    public function why_us(Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            'why_us_image' => 'required'
        ]);
        
        if($validation->passes())
        {
            $about = About::first();
            $about->why_us_image = $request->why_us_image;
            $about->save();


            return response()->json([
                'message'        => 'Why Us saved Successfully',
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
