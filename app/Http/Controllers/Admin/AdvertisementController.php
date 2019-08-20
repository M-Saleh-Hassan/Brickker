<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Media;
use App\Models\Advertisement;

use Validator;

class AdvertisementController extends Controller
{
    public function index()
    {
        $media  = Media::all();
        $advertisements = Advertisement::all();
        $products = Product::all();
        return view('admin.advertisements.index')
        ->with('media', $media)
        ->with('advertisements', $advertisements)
        ->with('products', $products)
        ->with('counter', 1);
    }

    public function addProduct(Request $request)
    {

        $validation = Validator::make($request->all(),
        [
            'product_title' => 'required',
            'product_id' => 'required|unique:advertisements,product_id',
            'product_image' => 'required',
        ]);
        if($validation->passes())
        {
            $product_title = $request->product_title;
            $product_id = $request->product_id;
            $product_image = $request->product_image;
            $advertisement = new Advertisement;
            $advertisement->title = $product_title;
            $advertisement->image = $product_image;
            $advertisement->route = 'en.product.index';
            $advertisement->product_id = $product_id;
            $advertisement->save();


            return response()->json([
                'message'        => 'Ad saved Successfully',
                'errors'         => '',
                'ad_title' => $product_title,
                'ad_id'    => $advertisement->id,
                'ad_link_edit'=> route('admin.ads.product.edit', [$advertisement->id]),
                'ad_count' => Advertisement::all()->count()
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

    public function editProduct(Request $request, $id)
    {
        $current = Advertisement::find($id);
        $media = Media::all();
        $products = Product::all();

        return view('admin.advertisements.edit')
        ->with('current', $current)
        ->with('media', $media)
        ->with('products', $products)
        ->with('counter', 1);

    }

    public function deleteProduct(Request $request)
    {
        $slide = Advertisement::find($request->id);
        $slide->delete();
        return response()->json(array('id' => $request->id), 200);
    }

    public function updateProduct(Request $request, $id)
    {
        $advertisement = Advertisement::find($id);
        
        $validation = Validator::make($request->all(),
        [
            'product_title' => 'required',
            'product_image' => 'required',
        ]);
        if($advertisement->product_id != $request->product_id)
        {
            $validation = Validator::make($request->all(),
            [
                'product_id'    => 'required|unique:advertisements,product_id',
                'product_title' => 'required',
                'product_image' => 'required',
            ]);

        }

        if($validation->passes())
        {
            $product_title = $request->product_title;
            $product_id = $request->product_id;
            $product_image = $request->product_image;
            $advertisement->title = $product_title;
            $advertisement->image = $product_image;
            $advertisement->route = 'en.product.index';
            $advertisement->product_id = $product_id;
            $advertisement->save();


            return response()->json([
                'message'        => 'Ad saved Successfully',
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
