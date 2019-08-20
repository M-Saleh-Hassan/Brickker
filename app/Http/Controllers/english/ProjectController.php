<?php

namespace App\Http\Controllers\english;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;
use Validator;

use App\User;
use App\Models\Project;
use App\Models\Subscription;
use App\Models\Room;
use App\Models\Flat;
use App\Models\Floor;
use App\Models\Projection;

class ProjectController extends Controller
{
    public function save(Request $request, $username_tag){
        $validation = Validator::make($request->all(),
        [
            'project_title' => 'required|max:51|min:3',
            'floors'        => 'required',
            'flats'         => 'required',
            'rooms'         => 'required',
        ]);
        
        if($validation->passes())
        {
            $user = User::where('username_tag', $username_tag)->first();
            $project = new Project;
            $project->user_id = $user->id;
            $project->title = $request->project_title;
            $project->save();
            
            /* Attach Floors to project */
            foreach($request->floors as $floor)
            {
                $floor_object = new Floor;
                $floor_object->project_id = $project->id;
                $floor_object->title = $floor;
                $floor_object->save();
            }

            /* Attach Flats to project */
            foreach($request->flats as $flat)
            {
                $flat_object = new Flat;
                $flat_object->project_id = $project->id;
                $flat_object->title = $flat;
                $flat_object->save();
            }

            /* Attach Rooms to project */
            foreach($request->rooms as $room)
            {
                $room_object = new Room;
                $room_object->project_id = $project->id;
                $room_object->title = $room;
                $room_object->save();
            }

            $projections = ['flooring', 'walls', 'ceiling'];
            /* Attach Projections to project */
            foreach($projections as $projection)
            {
                $projection_object = new Projection;
                $projection_object->project_id = $project->id;
                $projection_object->title = $projection;
                $projection_object->save();
            }
            
            $project_container = view('tashtebk.english.project.project_container')
                                ->with('project', $project)
                                ->render();
                                
            return response()->json([
                'message'           => 'Project Added Successfully',
                'status'            => 1,
                'errors'            => '',
                'project_container' => $project_container
            ]);
        }
        else
        {
            return response()->json([
                'message' => '',
                'status'  => 0,
                'errors'  => $validation->errors()->all(),
            ]);
        }
    }
    
    public function update(Request $request, $username_tag){
        $validation = Validator::make($request->all(),
        [
            'project_title' => 'required|max:51|min:3',
            'floors'        => 'required',
            'flats'         => 'required',
            'rooms'         => 'required',
        ]);
        
        if($validation->passes())
        {
            $user = User::where('username_tag', $username_tag)->first();
            $project = Project::find($request->project_id);
            $project->user_id = $user->id;
            $project->title = $request->project_title;
            $project->save();
            
            /* Delete old Floors */
            foreach($project->floors as $floor)Floor::find($floor->id)->delete();
            /* Delete old Flats */
            foreach($project->flats as $flat)Flat::find($flat->id)->delete();
            /* Delete old Rooms */
            foreach($project->rooms as $room)Room::find($room->id)->delete();
            
            /* Attach Floors to project */
            foreach($request->floors as $floor)
            {
                $floor_object = new Floor;
                $floor_object->project_id = $project->id;
                $floor_object->title = $floor;
                $floor_object->save();
            }

            /* Attach Flats to project */
            foreach($request->flats as $flat)
            {
                $flat_object = new Flat;
                $flat_object->project_id = $project->id;
                $flat_object->title = $flat;
                $flat_object->save();
            }

            /* Attach Rooms to project */
            foreach($request->rooms as $room)
            {
                $room_object = new Room;
                $room_object->project_id = $project->id;
                $room_object->title = $room;
                $room_object->save();
            }
            
            $project = Project::find($request->project_id);
            $project_container = view('tashtebk.english.project.project_container')
                                ->with('project', $project)
                                ->render();

            return response()->json([
                'message'           => 'Project Updated Successfully',
                'status'            => 1,
                'errors'            => '',
                'project_container' => $project_container,
                'project_id'        => $project->id
            ]);
        }
        else
        {
            return response()->json([
                'message' => '',
                'status'  => 0,
                'errors'  => $validation->errors()->all(),
            ]);
        }
    }
    
    public function delete(Request $request)
    {
        $project_id = $request->project_id;
        $project = Project::find($project_id)->delete();
        
        if($project)
            return response()->json([
                'message'    => 'Project Deleted Successfully.',
                'status'     => 1,
                'project_id' => $project_id
            ]);
        return response()->json([
            'message'    => 'Error',
            'status'     => 0,
            'project_id' => $project_id
        ]);


    }
    
    public function assign(Request $request)
    {
        $project_id      = $request->project_id;
        $subscription_id = $request->subscription_id;
        $redirect        = $request->redirect; 
        $subscription    = Subscription::find($subscription_id);
        $subscription->projects()->attach($project_id);
        
        return response()->json(array('redirect' => $redirect), 200);
    }
}