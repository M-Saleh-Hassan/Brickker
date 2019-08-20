<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductPhoto;
use App\Product;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function uploadForm()
    {
        return view('upload_form');
    }

    public function uploadSubmit(Request $request)
    {
        // This method will cover file upload
        $photos = [];
        foreach ($request->photos as $photo) {
            $filename = $photo->store('public/photos');
            $filename1 = str_replace('public/', 'storage/',$filename);
            $product_photo = ProductPhoto::create([
                'filename' => $filename1
            ]);
    
            $photo_object = new \stdClass();
            $photo_object->name = str_replace('photos/', '',$photo->getClientOriginalName());
            $photo_object->size = round(Storage::size($filename) / 1024, 2);
            $photo_object->fileID = $product_photo->id;
            $photo_object->link = $filename1;
            $photos[] = $photo_object;
        }
    
        return response()->json(array('files' => $photos), 200);
    }

    public function postProduct(Request $request)
    {
        // This method will cover whole product submit
        $product = Product::create($request->all());
        ProductPhoto::whereIn('id', explode(",", $request->file_ids))
            ->update(['product_id' => $product->id]);
        return 'Product saved successfully';    
    }

}
