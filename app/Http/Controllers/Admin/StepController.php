<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Models\Media;
use App\Models\Category;
use App\Models\UserType;
use App\Models\Scale;
use App\Models\ScaleStep;
use Validator;

class StepController  extends Controller
{
    public function index()
    {
        $media  = Media::all();
        $steps  = ScaleStep::all();
        $categories  = Category::where('parent_id', NULL)->get();
        $user_types = new UserType;
        $user_types = $user_types->getAvailableTypes();
        
        return view('admin.steps.index')
        ->with('media', $media)
        ->with('steps', $steps)
        ->with('categories', $categories)
        ->with('user_types', $user_types)
        ->with('counter', 1);
    }

    public function add(Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            'title'      => 'required|max:51|min:3|unique:scale_steps,title',
            'categories' => 'required',
            'user_types' => 'required'
        ]);
        
        if($validation->passes())
        {
            $title = $request->title;

            $step = new ScaleStep;
            $step->title = $title;
            $step->save();
            
            /* Attach categories to step */
            foreach($request->categories as $category)
            {
                $step->categories()->attach($category);
            }
            
            /* Attach user types to step */
            foreach($request->user_types as $type)
            {
                $step->userTypes()->attach($type);
            }
            

            return response()->json([
                'message'     => 'Step saved Successfully',
                'errors'      => '',
                'step_title' => $title,
                'step_id'    => $step->id,
                'step_link_edit' => route('admin.step.edit', [$step->id]),
                'step_count' => ScaleStep::all()->count()
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
        $current = ScaleStep::find($id);
        $media   = Media::all();
        $steps   = ScaleStep::all();
        $categories  = Category::where('parent_id', NULL)->get();
        $user_types = new UserType;
        $user_types = $user_types->getAvailableTypes();

        return view('admin.steps.edit')
        ->with('current', $current)
        ->with('media', $media)
        ->with('steps', $steps)
        ->with('categories', $categories)
        ->with('user_types', $user_types)
        ->with('counter', 1);

    }

    public function update(Request $request, $id)
    {
        $step =  ScaleStep::find($id);
        if($request->title != $step->title)
        {
            $validation = Validator::make($request->all(),
            [
                'title' => 'required|max:51|min:3|unique:scales,title',
                'categories' => 'required',
                'user_types' => 'required'
            ]);
        }
        else
        {
            $validation = Validator::make($request->all(),
            [
                'title' => 'required|max:51|min:3',
                'categories' => 'required',
                'user_types' => 'required'
            ]);
        }
        
        
        if($validation->passes())
        {
            
            $title    = $request->title;
            $step->title = $title;
            $step->save();
            
            /* Attach categories to Step */
            if($request->has('categories'))
            {
                /* Delete Old categories */ 
                foreach($step->categories as $one)
                {
                    $step->categories()->detach($one);
                }
                
                /* Add New categories */
                foreach($request->categories as $one)
                {
                    $step->categories()->attach($one);
                }
            }

            /* Attach User Types to Step */
            if($request->has('categories'))
            {
                /* Delete Old User Types */ 
                foreach($step->userTypes as $one)
                {
                    $step->userTypes()->detach($one);
                }
                
                /* Add New User Types */
                foreach($request->user_types as $one)
                {
                    $step->userTypes()->attach($one);
                }
            }

            return response()->json([
                'message'        => 'Step saved Successfully',
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
        $scale = ScaleStep::find($request->id);
        $scale->delete();
        return response()->json(array('id' => $request->id), 200);
    }


}
