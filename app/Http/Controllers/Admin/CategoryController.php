<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Models\Category;
use App\Models\Media;
use App\Models\UserType;
use App\Models\CategoryCode;
use Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $media = Media::all();
        $categories = Category::where('parent_id', NULL)->OrderBy('order','ASC')->get();
        $user_types = new UserType;
        $user_types = $user_types->getAvailableTypes();
        
        return view('admin.categories.index')
        ->with('media', $media)
        ->with('categories', $categories)
        ->with('user_types', $user_types)
        ->with('counter', 1);
    }

    public function add(Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            'title_en'      => 'required|max:51|min:3|unique:categories,title',
            'title_ar'      => 'required|max:51|min:3|unique:categories,title_ar',
            'order'      => 'required|numeric|min:1',
            //'media'      => 'required',
            'user_types' => 'required'
        ]);
        
        if($validation->passes())
        {
            $title = $request->title_en;
            $title_ar = $request->title_ar;
            $parent_category = ($request->parent_category == 'NULL') ? NULL : $request->parent_category;
            $order = $request->order;
            $show = ($request->show == '1') ? 1 : 0;
            $show_in_home = ($request->show_in_home == '1') ? 1 : 0;
            $category = new Category;
            $category->title     = $title;
            $category->title_ar  = $title_ar;
            $category->title_tag = $this->trimString($title);
            $category->parent_id = $parent_category;
            $category->order     = $order;
            $category->show      = $show;
            $category->home      = $show_in_home;
            $category->save();
            
            /* Attach media to category */
            $media_id = ($request->media) ? $request->media : 63; // 63 default-image
            $category->media()->attach($media_id);
            
            /* Attach User Types to category */
            foreach($request->user_types as $type)
            {
                $category->types()->attach($type);
            }
            
            $codes_string = '';
            /* Attach codes to category */
            foreach($request->codes as $code)
            {
                $codes_string .= $code .' ';
                $code_object = new CategoryCode;
                $code_object->category_id = $category->id;
                $code_object->code = $code;
                $code_object->save();
            }
            
            return response()->json([
                'message'        => 'Category saved Successfully',
                'errors'         => '',
                'category_title' => $title,
                'category_id'    => $category->id,
                'category_link_sub' => route('admin.categories.sub_categories', [$category->id]),
                'category_link_edit'=> route('admin.categories.edit', [$category->id]),
                'category_count' => Category::where('parent_id', NULL)->get()->count(),
                'category_order' => $category->order,
                'category_codes' => $codes_string
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
        $current = Category::find($id);
        $categories = Category::all();
        $media = Media::all();
        $user_types = new UserType;
        $user_types = $user_types->getAvailableTypes();

        return view('admin.categories.edit')
        ->with('current', $current)
        ->with('media', $media)
        ->with('categories', $categories)
        ->with('user_types', $user_types)
        ->with('counter', 1);

    }

    public function update(Request $request, $id)
    {
        $category =  Category::find($id);
        if($request->title_en != $category->title)
        {
            $validation = Validator::make($request->all(),
            [
                'title_en'      => 'required|max:51|min:3|unique:categories,title',
                'title_ar'      => 'required|max:51|min:3|unique:categories,title_ar',
                'order'      => 'required|numeric|min:1',
                'media'      => 'required',
                'user_types' => 'required',
            ]);
        }
        else
        {
            $validation = Validator::make($request->all(),
            [
                'title_en'      => 'required|max:51|min:3',
                'title_ar'   => 'required|max:51|min:3',
                'order'      => 'required|numeric|min:1',
                'media'      => 'required',
                'user_types' => 'required',
            ]);
        }
        
        
        if($validation->passes())
        {
            
            $title = $request->title_en;
            $title_ar = $request->title_ar;
            $parent_category = ($request->parent_category == 'NULL') ? NULL : $request->parent_category;
            $order = $request->order;
            $show = ($request->show == '1') ? 1 : 0;
            $show_in_home = ($request->show_in_home == '1') ? 1 : 0;
            $category =  Category::find($id);
            $category->title = $title;
            $category->title_ar = $title_ar;
            $category->title_tag = $this->trimString($title);
            $category->parent_id = $parent_category;
            $category->order = $order;
            $category->show = $show;
            $category->home = $show_in_home;
            $category->save();
            
            /* Attach media to category */
            $media_id = $request->media;
            if($category->getImage()->id != $media_id)
            {
                $pivot = DB::table('categories_media')->where('category_id', $id)->delete();
                $category->media()->attach($media_id);
            }
            
            /* Attach User Types to category */
            if($request->has('user_types'))
            {
                /* Delete Old types */ 
                foreach($category->types as $type)
                {
                    $category->types()->detach($type);
                }
                
                /* Add New types */
                foreach($request->user_types as $type)
                {
                    $category->types()->attach($type);
                }
            }

            /* Attach codes to category */
            if($request->has('codes'))
            {
                /* Delete old codes */ 
                foreach($category->codes as $code)
                {
                    $code->delete();
                }
                
                /* Add codes to category */
                foreach($request->codes as $code)
                {
                    $code_object = new CategoryCode;
                    $code_object->category_id = $category->id;
                    $code_object->code = $code;
                    $code_object->save();
                }
            }

            return response()->json([
                'message'        => 'Category saved Successfully',
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
        $category = Category::find($request->id);
        $category->delete();
        return response()->json(array('id' => $request->id), 200);
    }

    // public function getSubCategories(Request $request)
    // {
    //     $categories = Category::where('parent_id', $request->id)->get();
    //     return response()->json([
    //         'categories'  => $categories
    //     ]);
    // }

    public function showSubCategories(Request $request, $id)
    {
        $current = Category::find($id);
        $categories = Category::where('parent_id', $request->id)->get();

        return view('admin.categories.sub_categories')
        ->with('current', $current)
        ->with('categories', $categories)
        ->with('counter', 1);
    }
}
