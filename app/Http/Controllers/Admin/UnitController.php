<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Unit;

use Validator;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::all();
        
        return view('admin.unit.index')
        ->with('units', $units)
        ->with('counter', 1);
    }

    public function add(Request $request)
    {

        $validation = Validator::make($request->all(),
        [
            'title' => 'required|max:51',
        ]);
        if($validation->passes())
        {
            $title = $request->title;
            $unit = new Unit;
            $unit->title = $title;
            $unit->save();


            return response()->json([
                'message'        => 'Unit saved Successfully',
                'errors'         => '',
                'unit_title'     => $title,
                'unit_id'        => $unit->id,
                'unit_link_edit' => route('admin.units.edit', [$unit->id]),
                'unit_count'     => Unit::all()->count()

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
        $current = Unit::find($id);
        $units   = Unit::all();

        return view('admin.unit.edit')
        ->with('current', $current)
        ->with('units', $units)
        ->with('counter', 1);

    }

    public function delete(Request $request)
    {
        $unit = Unit::find($request->id);
        $unit->delete();
        return response()->json(array('id' => $request->id), 200);
    }

    public function update(Request $request, $id)
    {

        $validation = Validator::make($request->all(),
        [
            'title' => 'required|max:51',
        ]);
        if($validation->passes())
        {
            $title = $request->title;
            $unit = Unit::find($id);
            $unit->title = $title;
            $unit->save();


            return response()->json([
                'message'        => 'Unit saved Successfully',
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
