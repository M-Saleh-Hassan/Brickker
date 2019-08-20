<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;

use App\Models\Product;

use Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        
        return view('admin.products.index')
        ->with('products', $products)
        ->with('counter', 1);
    }
    
    public function edit(Request $request, $id)
    {
        $current = Product::find($id);

        return view('admin.products.edit')
        ->with('current', $current);

    }
    
    public function update(Request $request, $id)
    {
        return 1;
    }
    
    public function delete(Request $request)
    {
        $product = Product::find($request->id);
        $product->delete();
        return response()->json(array('id' => $request->id), 200);
    }
    
    public function makeFeatured(Request $request)
    {
        $product = Product::find($request->id);
        $product->featured = 1;
        $product->save();
        
        return response()->json(array('id' => $request->id), 200);
    }
    
    public function makeNotFeatured(Request $request)
    {
        $product = Product::find($request->id);
        $product->featured = 0;
        $product->save();
        
        return response()->json(array('id' => $request->id), 200);
    }
    
}
