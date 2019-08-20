<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Media;

use Validator;

class SliderController extends Controller
{
    public function index()
    {
        $media  = Media::all();
        $slides = Slider::all();
        return view('admin.slider.index')
        ->with('media', $media)
        ->with('slides', $slides)
        ->with('counter', 1);
    }

    public function add(Request $request)
    {

        $validation = Validator::make($request->all(),
        [
            'title' => 'required|max:51|min:3',
            'slide_order' => 'required|numeric|min:1',
            'media' => 'required',
            // 'text_value'  => 'required|min:10|max:200'
        ]);
        if($validation->passes())
        {
            $title = $request->title;
            $text = $request->text_value;
            $media_id = $request->media;
            $slide_order = $request->slide_order;
            $slide = new Slider;
            $slide->title = $title;
            $slide->text = $text;
            $slide->slide_order = $slide_order;
            $slide->media_id = $media_id;
            $slide->save();


            return response()->json([
                'message'        => 'Slide saved Successfully',
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

    public function edit(Request $request, $id)
    {
        $current = Slider::find($id);
        $slides = Slider::all();
        $media = Media::all();

        return view('admin.slider.edit')
        ->with('current', $current)
        ->with('media', $media)
        ->with('slides', $slides)
        ->with('counter', 1);

    }

    public function delete(Request $request)
    {
        $slide = Slider::find($request->id);
        $slide->delete();
        return response()->json(array('id' => $request->id), 200);
    }

    public function update(Request $request, $id)
    {

        $validation = Validator::make($request->all(),
        [
            'title' => 'required|max:51|min:3',
            'slide_order' => 'required|numeric|min:1',
            'media' => 'required',
            // 'text_value'  => 'required|min:10|max:200'
        ]);
        if($validation->passes())
        {
            $title = $request->title;
            $text = $request->text_value;
            $media_id = $request->media;
            $slide_order = $request->slide_order;
            $slide = Slider::find($id);
            $slide->title = $title;
            $slide->text = $text;
            $slide->slide_order = $slide_order;
            $slide->media_id = $media_id;
            $slide->save();


            return response()->json([
                'message'        => 'Slide saved Successfully',
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
