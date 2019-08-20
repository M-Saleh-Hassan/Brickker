<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;

use App\Models\Slider;
use App\Models\Media;
use App\Models\UserType;
use App\User;

use Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereHas('userType', function (Builder $query) {
            $query->where('id', '<>', 1);
        })->orderBy('user_type','DESC')->get();
        
        return view('admin.users.index')
        ->with('users', $users)
        ->with('counter', 1);
    }
    
    public function edit(Request $request, $id)
    {
        $current = User::find($id);

        return view('admin.users.edit')
        ->with('current', $current);

    }
    
    public function update(Request $request, $id)
    {
        return 1;
    }
    
    public function delete(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        return response()->json(array('id' => $request->id), 200);

    }
    
    public function getAllTypes()
    {
        $types = UserType::all();
        $media = Media::all(); 
        
        return view('admin.users.types.index')
        ->with('types', $types)
        ->with('media', $media)
        ->with('counter', 1);
    }

    public function typeAdd(Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            'type' => 'required|max:51|min:3',
            'media' => 'required',
        ]);
        
        if($validation->passes())
        {
            $title = $request->type;
            $media_id = $request->media;
            $type = new UserType;
            $type->type = $title;
            $type->media_id = $media_id;
            $type->save();

            return response()->json([
                'message'        => 'Type saved Successfully',
                'errors'         => '',
                'type_title' => $title,
                'type_id'    => $type->id,
                'type_link_edit'=> route('admin.categories.edit', [$type->id]),
                'type_count' => UserType::all()->count()
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
    
    public function typeEdit($id)
    {
        $current = UserType::find($id);
        $media = Media::all();

        return view('admin.users.types.edit')
        ->with('current', $current)
        ->with('media', $media)
        ->with('counter', 1);

    }

    public function typeUpdate(Request $request, $id)
    {
        $type =  UserType::find($id);
        
        $validation = Validator::make($request->all(),
        [
            'type' => 'required|max:51|min:3',
            'media' => 'required',
        ]);
        
        
        if($validation->passes())
        {
            
            $type->type = $request->type;
            $type->media_id = $request->media;
            $type->save();

            return response()->json([
                'message'   => 'Type saved Successfully',
                'errors'    => '',
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
    
    public function typeDelete(Request $request)
    {
        $type = UserType::find($request->id);
        $type->delete();
        return response()->json(array('id' => $request->id), 200);
    }
}
