<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Currency;

use Validator;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::all();
        
        return view('admin.currency.index')
        ->with('currencies', $currencies)
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
            
            $currency = new Currency;
            $currency->title_en = $title_en;
            $currency->title_ar = $title_ar;
            $currency->save();


            return response()->json([
                'message'        => 'Currency saved Successfully',
                'errors'         => '',
                'currency_title'     => $title_en,
                'currency_id'        => $currency->id,
                'currency_link_edit' => route('admin.currencies.edit', [$currency->id]),
                'currency_count'     => Currency::all()->count()

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
        $current = Currency::find($id);
        $currencies   = Currency::all();

        return view('admin.currency.edit')
        ->with('current', $current)
        ->with('currencies', $currencies)
        ->with('counter', 1);

    }

    public function delete(Request $request)
    {
        $currency = Currency::find($request->id);
        $currency->delete();
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
            
            $currency = Currency::find($id);
            $currency->title_en = $title_en;
            $currency->title_ar = $title_ar;
            $currency->save();


            return response()->json([
                'message'        => 'Currency saved Successfully',
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

    public function active(Request $request)
    {
        Currency::where('active',1)->update(['active' => 0]);
        $currency = Currency::find($request->id);
        $currency->active = 1;
        $currency->save();
        
        return response()->json(array('id' => $request->id), 200);
    }
    
    public function deactive(Request $request)
    {
        $currency = Currency::find($request->id);
        $currency->active = 0;
        $currency->save();
        
        return response()->json(array('id' => $request->id), 200);
    }
}
