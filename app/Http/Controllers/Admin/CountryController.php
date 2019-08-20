<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Country;

use Validator;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        
        return view('admin.country.index')
        ->with('countries', $countries)
        ->with('counter', 1);
    }

    public function add(Request $request)
    {

        $validation = Validator::make($request->all(),
        [
            'title_en' => 'required|max:51',
            'title_ar' => 'required|max:51',
        ]);
        if($validation->passes())
        {
            $title_en = $request->title_en;
            $title_ar = $request->title_ar;
            
            $country = new Country;
            $country->title_en = $title_en;
            $country->title_ar = $title_ar;
            $country->save();


            return response()->json([
                'message'        => 'Country saved Successfully',
                'errors'         => '',
                'Country_title'     => $title_en,
                'Country_id'        => $country->id,
                'Country_link_edit' => route('admin.countries.edit', [$country->id]),
                'Country_count'     => Country::all()->count()

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
        $current = Country::find($id);
        $countries   = Country::all();

        return view('admin.country.edit')
        ->with('current', $current)
        ->with('countries', $countries)
        ->with('counter', 1);

    }

    public function delete(Request $request)
    {
        $country = Country::find($request->id);
        $country->delete();
        return response()->json(array('id' => $request->id), 200);
    }

    public function update(Request $request, $id)
    {

        $validation = Validator::make($request->all(),
        [
            'title_en' => 'required|max:51',
            'title_ar' => 'required|max:51',
        ]);
        if($validation->passes())
        {
            $title_en = $request->title_en;
            $title_ar = $request->title_ar;
            
            $country = Country::find($id);
            $country->title_en = $title_en;
            $country->title_ar = $title_ar;
            $country->save();


            return response()->json([
                'message'        => 'Country saved Successfully',
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
