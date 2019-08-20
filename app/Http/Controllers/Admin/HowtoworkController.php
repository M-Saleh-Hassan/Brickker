<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Howtowork;
use App\Models\Media;

use Validator;

class HowtoworkController extends Controller
{
    public function index()
    {
        $howtoworks = Howtowork::all();
        $media = Media::all();
        
        return view('admin.howtowork.index')
        ->with('howtoworks', $howtoworks)
        ->with('media', $media);
    }

    public function add(Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            'header_en' => 'required',
            'header_ar' => 'required',
            'text_en'   => 'required',
            'text_ar'   => 'required',
            'order'     => 'required',
            'image_id'  => 'required'
        ]);
        
        if($validation->passes())
        {
            $howtowork= new Howtowork;
            $howtowork->header_en = $request->header_en;
            $howtowork->header_ar = $request->header_ar;
            $howtowork->text_en   = $request->text_en;
            $howtowork->text_ar   = $request->text_ar;
            $howtowork->image_id  = $request->image_id;
            $howtowork->order     = $request->order;
            $howtowork->save();


            return response()->json([
                'message'       => 'How To Work saved Successfully',
                'errors'        => '',
                'howtowork_header_en' => $howtowork->header_en ,
                'howtowork_id'        => $howtowork->id,
                'howtowork_link_edit' => route('admin.howtowork.edit', [$howtowork->id]),
                'howtowork_order'     => $howtowork->order,
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

    public function edit(Request $request, $id)
    {
        $current = Howtowork::find($id);
        $media = Media::all();

        return view('admin.howtowork.edit')
        ->with('current', $current)
        ->with('media', $media);
    }
    
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(),
        [
            'header_en' => 'required',
            'header_ar' => 'required',
            'text_en'   => 'required',
            'text_ar'   => 'required',
            'order'     => 'required',
        ]);
        
        if($validation->passes())
        {
            $howtowork= Howtowork::find($id);
            $howtowork->header_en = $request->header_en ;
            $howtowork->header_ar = $request->header_ar ;
            $howtowork->text_en   = $request->text_en   ;
            $howtowork->text_ar   = $request->text_ar   ;
            $howtowork->image_id  = $request->image_id  ;
            $howtowork->order     = $request->order;
            $howtowork->save();


            return response()->json([
                'message'        => 'How To Work saved Successfully',
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

    public function delete(Request $request)
    {
        $howtowork= Howtowork::find($request->id);
        $howtowork->delete();
        return response()->json(array('id' => $request->id), 200);
    }


}
