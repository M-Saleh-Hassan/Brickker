<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faq;

use Validator;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();
        
        return view('admin.faqs.index')
        ->with('faqs', $faqs);
    }

    public function add(Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            'question_en' => 'required',
            'question_ar' => 'required',
            'answer_en'   => 'required',
            'answer_ar'   => 'required',
            'order'       => 'required'
        ]);
        
        if($validation->passes())
        {
            $faq = new Faq;
            $faq->question_en = $request->faq_question_text_en;
            $faq->question_ar = $request->faq_question_text_ar;
            $faq->answer_en   = $request->faq_answer_text_en;
            $faq->answer_ar   = $request->faq_answer_text_ar;
            $faq->order       = $request->order;
            $faq->save();


            return response()->json([
                'message'      => 'FAQ saved Successfully',
                'errors'       => '',
                'faq_question' => $faq->question_en,
                'faq_id'       => $faq->id,
                'faq_link_edit'=> route('admin.faqs.edit', [$faq->id]),
                'faq_order' => $faq->order,
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
        $current = Faq::find($id);

        return view('admin.faqs.edit')
        ->with('current', $current);
    }
    
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(),
        [
            'question_en' => 'required',
            'question_ar' => 'required',
            'answer_en'   => 'required',
            'answer_ar'   => 'required',
            'order'       => 'required'
        ]);
        
        if($validation->passes())
        {
            $faq = Faq::find($id);
            $faq->question_en = $request->faq_question_text_en;
            $faq->question_ar = $request->faq_question_text_ar;
            $faq->answer_en   = $request->faq_answer_text_en;
            $faq->answer_ar   = $request->faq_answer_text_ar;
            $faq->order       = $request->order;
            $faq->save();


            return response()->json([
                'message'        => 'FAQ saved Successfully',
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
        $faq = Faq::find($request->id);
        $faq->delete();
        return response()->json(array('id' => $request->id), 200);
    }


}
