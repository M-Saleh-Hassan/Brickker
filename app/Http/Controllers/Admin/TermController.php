<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Term;

use Validator;

class TermController extends Controller
{
    public function index()
    {
        $term = Term::first();

        return view('admin.term.index')
        ->with('term', $term);
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
            $term = Term::first();
            $term->content_en = $request->term_text_en;
            $term->content_ar = $request->term_text_ar;
            $term->save();


            return response()->json([
                'message'        => 'term saved Successfully',
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
