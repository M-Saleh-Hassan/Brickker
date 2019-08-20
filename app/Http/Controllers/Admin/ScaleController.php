<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Models\Media;
use App\Models\Scale;
use App\Models\ScaleStep;
use Validator;

class ScaleController extends Controller
{
    public function index()
    {
        $media  = Media::all();
        $scales = Scale::all();
        $steps  = ScaleStep::all();
        
        return view('admin.scales.index')
        ->with('media', $media)
        ->with('scales', $scales)
        ->with('steps', $steps)
        ->with('counter', 1);
    }

    public function add(Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            'title' => 'required|max:51|min:3|unique:scales,title',
            'order' => 'required',
            'media' => 'required',
            'steps' => 'required'
        ]);
        
        if($validation->passes())
        {
            $title       = $request->title;
            $order       = $request->order;
            $media_id    = $request->media;
            $description = $request->description;
            
            $scale = new Scale;
            $scale->title       = $title;
            $scale->order       = $order;
            $scale->media_id    = $media_id;
            $scale->description = $description;
            $scale->save();
            
            $step_order = 1;
            /* Attach steps to scale */
            foreach($request->steps as $step)
            {
                $scale->scaleSteps()->attach($step, ['step_order' => $step_order]);
                $step_order++;
            }
            

            return response()->json([
                'message'     => 'Scale saved Successfully',
                'errors'      => '',
                'scale_title' => $title,
                'scale_id'    => $scale->id,
                'scale_link_edit'=> route('admin.scale.edit', [$scale->id]),
                'scale_count' => Scale::all()->count(),
                'scale_order' => $scale->order
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
        $current = Scale::find($id);
        $media   = Media::all();
        $steps   = ScaleStep::all();

        return view('admin.scales.edit')
        ->with('current', $current)
        ->with('media', $media)
        ->with('steps', $steps)
        ->with('counter', 1);

    }

    public function update(Request $request, $id)
    {
        $scale =  Scale::find($id);
        if($request->title != $scale->title)
        {
            $validation = Validator::make($request->all(),
            [
                'title' => 'required|max:51|min:3|unique:scales,title',
                'order' => 'required',
                'media' => 'required',
                'steps' => 'required'
            ]);
        }
        else
        {
            $validation = Validator::make($request->all(),
            [
                'title' => 'required|max:51|min:3',
                'order' => 'required',
                'media' => 'required',
                'steps' => 'required'
            ]);
        }
        
        
        if($validation->passes())
        {
            
            $title       = $request->title;
            $order       = $request->order;
            $media_id    = $request->media;
            $description = $request->description;
            
            $scale->title       = $title;
            $scale->order       = $order;
            $scale->media_id    = $media_id;
            $scale->description = $description;
            $scale->save();
            
            $step_order = 1;
            /* Attach steps to scale */
            if($request->has('steps'))
            {
                /* Delete Old steps */ 
                foreach($scale->scaleSteps as $step)
                {
                    $scale->scaleSteps()->detach($step);
                }
                
                /* Add New steps */
                foreach($request->steps as $step)
                {
                    $scale->scaleSteps()->attach($step, ['step_order' => $step_order]);
                    $step_order++;
                }
            }

            return response()->json([
                'message'        => 'Scale saved Successfully',
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
        $scale = Scale::find($request->id);
        $scale->delete();
        return response()->json(array('id' => $request->id), 200);
    }


}
