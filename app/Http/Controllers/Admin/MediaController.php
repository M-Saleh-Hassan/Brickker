<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Media;

use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $all_media = Media::all();
        return view('admin.media.index')
            ->with('all_media', $all_media)
            ->with('counter', 1);
    }

    public function uploadSubmit(Request $request)
    {
        // This method will cover file upload
        $photos = [];
        foreach ($request->photos as $photo) {
            $name = date('mdYHis') . uniqid() . $photo->getClientOriginalName();
            $filename = $photo->move('storage/photos/', $name);

            // $link = str_replace('public/', 'storage/',$filename);
            $link = 'storage/photos/'.$name;
            $original_name = $photo->getClientOriginalName();
            $type = $photo->getClientOriginalExtension();
            // $size = round(Storage::size($filename) / 1024, 2);
            $size = round($photo->getSize() / 1024, 2);
            
            $media_object = new Media;
            $media_object->original_name = $original_name;
            $media_object->size = $size;
            $media_object->link = $link;
            $media_object->type = $type;
            $media_object->save();

            $photo_object = new \stdClass();
            $photo_object->name = $original_name;
            $photo_object->size = $size;
            $photo_object->fileID = $media_object->id;
            $photo_object->link = $link;
            $photo_object->type = $type;
            $photos[] = $photo_object;
        }
    
        return response()->json(array('files' => $photos), 200);
    }

    public function deleteFile(Request $request)
    {
        $media = Media::find($request->id);
        $media->delete();
        return response()->json(array('id' => $request->id), 200);
    }

}
