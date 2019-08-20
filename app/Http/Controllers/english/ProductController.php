<?php

namespace App\Http\Controllers\english;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Models\Currency;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductAdditional;
use App\Models\Order;
use App\Models\Favorite;
use App\Models\Quantity;
use App\Models\QuantityAdditional;

class ProductController extends Controller
{
    public function index($title_tag)
    {
        $product = product::where('title_tag', $title_tag)->first();
        if(empty($product))return redirect()->route('home.index');
        
        $orders = [];
        if(Auth::check())
        {
            $orders       = Order::where('user_id', Auth::user()->id)->get();
            $orders_count = $orders->count();
        }
        
        else $orders_count = 0;
        
        $orders_tbody = "";
        foreach($orders as $order)
        {
            $orders_tbody .= view('tashtebk.english.checkout.checkout_row')
            ->with('order', $order)
            ->render();
        }
       
        
        return view('tashtebk.english.product.index')
        ->with('product', $product)
        ->with('orders_count', $orders_count)
        ->with('orders_tbody', $orders_tbody);
    }

    public function save(Request $request, $username_tag)
    {
        $user = User::where('username_tag', $username_tag)->first();

        $rules= [
            'product_title'             => 'required|unique:user_products,title',
            'product_category'          => 'required',
            'product_unit'              => 'required',
            'product_short_description' => 'required|max:191',
            'product_long_description'  => 'required',
            'product_brand'             => 'required',
            'product_model_name'        => 'required',
            'product_grade'             => 'required',
            'product_price'             => 'required|numeric|min:0',
            'product_discount'          => 'required|numeric|min:0|max:99',
            'product_image'             => 'required|max:500|mimes:jpeg,bmp,png,jpg',
            // 'product_other_images'      => 'required',
            'product_other_images.*'    => 'image|max:500|mimes:jpeg,bmp,png,jpg',
        ];
        
        $messages = [
            'required'    => 'The :attribute field is required',              
        ];      

        $this->validate($request, $rules, $messages);

        $product = new Product;
        $product->user_id = $user->id; 
        $product->category_id = $request->product_category; 
        $product->unit_id = $request->product_unit; 
        $product->title = $request->product_title; 
        $product->title_tag = $this->trimString($request->product_title);
        $product->short_description = $request->product_short_description; 
        $product->long_description = $request->product_long_description; 
        $product->price = $request->product_price; 
        $product->discount = $request->product_discount; 
        $product->brand = $request->product_brand; 
        $product->grade = $request->product_grade; 
        $product->model_name = $request->product_model_name; 

        //Image
        if(request()->hasFile('product_image'))
        {
            $file=$request['product_image'];
            $name =  date('mdYHis') . uniqid() . $file->getClientOriginalName();
            $name = str_replace(' ', '_', $name);
            $request->file('product_image')->move('tashtebk/images/products/', $name);
            $product->image='tashtebk/images/products/'.$name;
        }
        
        $product->save();
        
        //Other Images
        if($request->hasfile('product_other_images'))
        {
            foreach($request->file('product_other_images') as $image)
            {

                $name = date('mdYHis') . uniqid() . $image->getClientOriginalName();
                $name = str_replace(' ', '_', $name);
                $image->move('tashtebk/images/products/', $name);
                $product_images = new ProductImage;
                $product_images->image='tashtebk/images/products/'.$name;
                $product_images->product_id = $product->id;
                $product_images->save();
                $data[] = $name;  
            }
        }
        
        //Additional Products
        $additional_products_title_tags = $request->additional_product;
        if(!empty($additional_products_title_tags))
        {
            $additional_products_title_tags_array = explode (",", $additional_products_title_tags);
            foreach($additional_products_title_tags_array as $product_title)
            {
                $current = Product::where('title_tag', $product_title)->first();
                
                $product_additional = new ProductAdditional;
                $product_additional->parent_product_id= $product->id;
                $product_additional->child_product_id = $current->id;
                $product_additional->save();
            }
        }

        return redirect()->route('en.profile.index', ['username_tag' => $user->username_tag])
        ->with('success', 'Product Added Successfully')
        ->with('active', 'my_products');
    }

    public function update(Request $request, $username_tag, $product_id)
    {
        $user = User::where('username_tag', $username_tag)->first();
        $product = Product::find($product_id);
        
        $rules= [
            'product_category'          => 'required',
            'product_unit'              => 'required',
            'product_short_description' => 'required|max:191',
            'product_long_description'  => 'required',
            'product_brand'             => 'required',
            'product_model_name'        => 'required',
            'product_grade'             => 'required',
            'product_price'             => 'required|numeric|min:0',
            'product_discount'          => 'required|numeric|min:0|max:99',
        ];
        
        $messages = [
            'required'    => 'The :attribute field is required',              
        ];      

        if($request->hasFile('product_image'))$rules['product_image'] = 'required|max:500|mimes:jpeg,bmp,png,jpg';
        if($request->hasFile('product_other_images'))$rules['product_other_images.*'] = 'image|max:500|mimes:jpeg,bmp,png,jpg';
        if($request->product_title != $product->title) $rules['product_title'] = 'required|unique:user_products,title';
        if($request->product_title != $product->title) return 1;

        $this->validate($request, $rules, $messages);

        $product->category_id = $request->product_category; 
        $product->unit_id = $request->product_unit;
        $product->title = $request->product_title; 
        $product->title_tag = $this->trimString($request->product_title);
        $product->short_description = $request->product_short_description; 
        $product->long_description = $request->product_long_description; 
        $product->price = $request->product_price; 
        $product->discount = $request->product_discount; 
        $product->brand = $request->product_brand; 
        $product->grade = $request->product_grade; 
        $product->model_name = $request->product_model_name; 

        //Image
        if($request->hasFile('product_image'))
        {
            $file=$request['product_image'];
            $name =  date('mdYHis') . uniqid() . $file->getClientOriginalName();
            $name = str_replace(' ', '_', $name);
            $request->file('product_image')->move('tashtebk/images/products/', $name);
            $product->image='tashtebk/images/products/'.$name;
        }
        
        $product->save();
        
        //Other Images
        if($request->hasfile('product_other_images'))
        {
            // /* Delete old images */ 
            // foreach($product->images as $image)
            // {
            //     $image->delete();
            // }
            
            /* Add Images to Product */
            foreach($request->file('product_other_images') as $image)
            {

                $name = date('mdYHis') . uniqid() . $image->getClientOriginalName();
                $name = str_replace(' ', '_', $name);
                $image->move('tashtebk/images/products/', $name);
                $product_images = new ProductImage;
                $product_images->image='tashtebk/images/products/'.$name;
                $product_images->product_id = $product->id;
                $product_images->save();
                $data[] = $name;  
            }
        }
        
        //Additional Products
        $additional_products_title_tags = $request->additional_product;
        if(!empty($additional_products_title_tags))
        {
            /* Delete Additional Products */ 
            foreach($product->additionalProducts as $one)
            {
                $one->delete();
            }
            
            /* Add Additional Products to Product */
            $additional_products_title_tags_array = explode (",", $additional_products_title_tags);
            foreach($additional_products_title_tags_array as $product_title)
            {
                $current = Product::where('title_tag', $product_title)->first();
                
                $product_additional = new ProductAdditional;
                $product_additional->parent_product_id= $product->id;
                $product_additional->child_product_id = $current->id;
                $product_additional->save();
            }
        }
        
        return redirect()->route('en.profile.index', ['username_tag' => $user->username_tag])
        ->with('success', 'Product Updated Successfully')
        ->with('active', 'my_products');

    }
    
    public function delete(Request $request, $username_tag, $product_id)
    {
        $product = product::where('id', $product_id)->delete();
        if($product)
        {
            return redirect()->route('en.profile.index', [$username_tag])
            ->with('success', 'Product Deleted Successfully')
            ->with('active', 'my_products');
        }
        else
        {
            return redirect()->route('en.profile.index', [$username_tag])
            ->with('success', 'Error')
            ->with('active', 'my_products');
        }

    }
    
    public function filter(Request $request, $username_tag)
    {
        $active_currency = Currency::where('active',1)->first();
        $search_value = $request->search_value;
        $additional_products_current_value = $request->additional_products_current_value;
        $products = Product::where('title', 'LIKE', '%'.$search_value.'%')->get();
        $products_title_tags_array = explode (",", $additional_products_current_value);
        if(empty($search_value)) $products = Product::whereIn('title_tag', $products_title_tags_array)->get();
        
        $content = '';
        foreach ($products as $product):
            $content .= '<div class="col-md-3">';
            $content .=     '<div class="p-item relate-item">';
            if(strpos($additional_products_current_value, $product->title_tag) !== false)$content .= '<div class="check"><i class="fa fa-check"></i></div>';
            $content .=         '<div class="overlay-product">';
            $content .=             '<div class="elements">';
            $content .=                 '<a class="primary add-additional-product"  title="Add" data-content="'.$product->title_tag.'"><i class="fa fa-plus"></i></a>';
            $content .=                 '<a href="' . route('en.product.index', ['title_tag'=>$product->title_tag]) . '" class="success" title="view" target="_blank"><i class="fa fa-eye"></i></a>';
            $content .=                 '<a class="danger delete-additional-product" title="Delete" data-content="'.$product->title_tag.'"><i class="fa fa-close"></i></a>';
            $content .=             '</div>';
            $content .=         '</div>';
            
            $content .=         '<div class="img-item">';
            $content .=             '<img src="' . asset('').$product->image . '" alt="" style="height:110px;">';
            $content .=         '</div>';
                    
            $content .=         '<div class="p-info">';
            $content .=             '<h4>' . $product->title . '</h4>';
            $content .=             '<div>';
            $content .=                 '<a href="#"><i class="fa fa-heart-o"></i></a>';
            $content .=                 '<a href="' . route('en.product.index', ['title_tag'=>$product->title_tag]) . '"><i class="fa fa-shopping-cart"></i></a>';
            $content .=                 '<span class="price-p">' . $product->current_price . $active_currency->title_en . '</span>';
            $content .=             '</div>';
            $content .=         '</div>';
            
            $content .=     '</div>';
            $content .= '</div>';                                                                   
        endforeach;
        
        return response()->json(array('result' => $content), 200);
    }
    
    public function filterMainQuantity(Request $request, $username_tag)
    {
        $search_value = $request->search_value;
        $main_product_ids = $request->main_product_id;
        $main_product_ids_array = explode (",", $main_product_ids);
        if(empty($main_product_ids_array)) $main_product_ids_array = $main_product_ids;
        $products = Product::where('title', 'LIKE', '%'.$search_value.'%')->get();
        
        $products = view('tashtebk.english.product.layouts.ajax_main_products')
        ->with('products', $products)
        ->with('main_product_id', $main_product_ids_array)
        ->render();
        
        return response()->json(array('products' => $products), 200);
        
    }
    
    public function filterMainQuantityByCategory(Request $request, $username_tag)
    {
        $category_id = $request->category_id;
        $main_product_ids = $request->main_product_id;
        $main_product_ids_array = explode (",", $main_product_ids);
        if(empty($main_product_ids_array)) $main_product_ids_array = $main_product_ids;

        $products = Product::where('category_id', $category_id)->get();
        
        $products = view('tashtebk.english.product.layouts.ajax_main_products')
        ->with('products', $products)
        ->with('main_product_id', $main_product_ids_array)
        ->render();
        
        return response()->json(array('products' => $products), 200);
        
    }
    
    public function chooseMainQuantity(Request $request, $username_tag)
    {
        $main_product_id = $request->main_product_id;
        $product = Product::find($main_product_id);
        
        $main_product = view('tashtebk.english.product.layouts.single_product_selected')
        ->with('product', $product)
        ->render();
        
        return response()->json(array('main_product' => $main_product), 200);
        
    }

    public function selectedMainQuantity(Request $request, $username_tag)
    {
        $main_product_ids = $request->main_product_ids;
        $main_product_ids_array = explode (",", $main_product_ids);
        if(empty($main_product_ids_array)) $main_product_ids_array = $main_product_ids;
        
        $selected_main_products = Product::whereIn('id', $main_product_ids_array)->get();
        
        $selected_main_products = view('tashtebk.english.product.layouts.selected_main_products')
        ->with('products', $selected_main_products)
        ->render();
        
        return response()->json(array('selected_main_products' => $selected_main_products), 200);
    }    
    
    public function allMainQuantity(Request $request, $username_tag)
    {
        $main_product_ids = $request->main_product_id;
        $main_product_ids_array = explode (",", $main_product_ids);
        if(empty($main_product_ids_array)) $main_product_ids_array = $main_product_ids;

        $all_products = Product::all();
        
        $all_products = view('tashtebk.english.product.layouts.ajax_main_products')
        ->with('products', $all_products)
        ->with('main_product_id', $main_product_ids_array)
        ->render();
        
        return response()->json(array('all_products' => $all_products), 200);
    }
    
    public function filterSubQuantity(Request $request, $username_tag)
    {
        $search_value = $request->search_value;
        $sub_product_ids = $request->sub_product_ids;
        $sub_product_ids_array = explode (",", $sub_product_ids);
        if(empty($sub_product_ids_array)) $sub_product_ids_array = $sub_product_ids;
        
        $sub_product_quantities = $request->sub_product_quantities;
        $sub_product_quantities_array = explode (",", $sub_product_quantities);
        if(empty($sub_product_quantities_array)) $sub_product_quantities_array = $sub_product_quantities;
        
        $products = Product::where('title', 'LIKE', '%'.$search_value.'%')->get();
        $current_quantities = [];
        foreach($products as $product)
        {
            $flag = 1;
            for($i=0; $i<count($sub_product_ids_array); $i++)
            {
                if($sub_product_ids_array[$i] == $product->id)
                {
                    $current_quantities[$sub_product_ids_array[$i]] = $sub_product_quantities_array[$i];
                    $flag = 0;
                    break;
                }
            }
            if($flag) $current_quantities[$product->id] = 1;
            
        }
        
        $products = view('tashtebk.english.product.layouts.ajax_sub_products')
        ->with('products', $products)
        ->with('sub_product_ids', $sub_product_ids_array)
        ->with('current_quantities', $current_quantities)
        ->render();
        
        return response()->json(array('products' => $products), 200);
        
    }
    
    public function filterSubQuantityByCategory(Request $request, $username_tag)
    {
        $category_id = $request->category_id;
        $sub_product_ids = $request->sub_product_ids;
        $sub_product_ids_array = explode (",", $sub_product_ids);
        if(empty($sub_product_ids_array)) $sub_product_ids_array = $sub_product_ids;

        $sub_product_quantities = $request->sub_product_quantities;
        $sub_product_quantities_array = explode (",", $sub_product_quantities);
        if(empty($sub_product_quantities_array)) $sub_product_quantities_array = $sub_product_quantities;

        $products = Product::where('category_id', $category_id)->get();
        
        $current_quantities = [];
        foreach($products as $product)
        {
            $flag = 1;
            for($i=0; $i<count($sub_product_ids_array); $i++)
            {
                if($sub_product_ids_array[$i] == $product->id)
                {
                    $current_quantities[$sub_product_ids_array[$i]] = $sub_product_quantities_array[$i];
                    $flag = 0;
                    break;
                }
            }
            if($flag) $current_quantities[$product->id] = 1;
            
        }
        
       
        $products = view('tashtebk.english.product.layouts.ajax_sub_products')
        ->with('products', $products)
        ->with('sub_product_ids', $sub_product_ids_array)
        ->with('current_quantities', $current_quantities)
        ->render();
        
        return response()->json(array('products' => $products), 200);
        
    }

    
    public function selectedSubQuantity(Request $request, $username_tag)
    {
        $sub_product_ids = $request->sub_product_ids;
        $sub_product_ids_array = explode (",", $sub_product_ids);
        if(empty($sub_product_ids_array)) $sub_product_ids_array = $sub_product_ids;
        
        $sub_product_quantities = $request->sub_product_quantities;
        $sub_product_quantities_array = explode (",", $sub_product_quantities);
        if(empty($sub_product_quantities_array)) $sub_product_quantities_array = $sub_product_quantities;
        
        $selected_sub_products = Product::whereIn('id', $sub_product_ids_array)->get();
        
        $current_quantities = [];
        
        foreach($selected_sub_products as $product)
        {
            $flag = 1;
            for($i=0; $i<count($sub_product_ids_array); $i++)
            {
                if($sub_product_ids_array[$i] == $product->id)
                {
                    $current_quantities[$sub_product_ids_array[$i]] = $sub_product_quantities_array[$i];
                    $flag = 0;
                    break;
                }
            }
            if($flag) $current_quantities[$product->id] = 1;
            
        }
        
        $selected_sub_products = view('tashtebk.english.product.layouts.selected_sub_products')
        ->with('products', $selected_sub_products)
        ->with('current_quantities', $current_quantities)
        ->render();
        
        return response()->json(array('selected_sub_products' => $selected_sub_products, 'current_quantities' => $current_quantities), 200);
    }
    
    public function allSubQuantity(Request $request, $username_tag)
    {
        $sub_product_ids = $request->sub_product_ids;
        $sub_product_ids_array = explode (",", $sub_product_ids);
        if(empty($sub_product_ids_array)) $sub_product_ids_array = $sub_product_ids;
        
        $sub_product_quantities = $request->sub_product_quantities;
        $sub_product_quantities_array = explode (",", $sub_product_quantities);
        if(empty($sub_product_quantities_array)) $sub_product_quantities_array = $sub_product_quantities;
        $all_products = Product::all();
        $current_quantities = [];
        foreach($all_products as $product)
        {
            $flag = 1;
            for($i=0; $i<count($sub_product_ids_array); $i++)
            {
                if($sub_product_ids_array[$i] == $product->id)
                {
                    $current_quantities[$sub_product_ids_array[$i]] = $sub_product_quantities_array[$i];
                    $flag = 0;
                    break;
                }
            }
            if($flag) $current_quantities[$product->id] = 1;
            
        }
        
        $all_products = view('tashtebk.english.product.layouts.ajax_sub_products')
        ->with('products', $all_products)
        ->with('sub_product_ids', $sub_product_ids_array)
        ->with('current_quantities', $current_quantities)
        ->render();
        
        return response()->json(array('all_products' => $all_products), 200);
    }

    public function addQuantity(Request $request, $username_tag)
    {
        $user = User::where('username_tag', $username_tag)->first();
        
        $main_product_ids = $request->main_product_ids;
        $main_product_ids_array = explode (",", $main_product_ids);
        if(empty($main_product_ids_array)) $main_product_ids_array = $main_product_ids;

        $sub_product_ids = $request->sub_product_ids;
        $sub_product_ids_array = explode (",", $sub_product_ids);
        if(empty($sub_product_ids_array)) $sub_product_ids_array = $sub_product_ids;
        
        $sub_product_quantities = $request->sub_product_quantities;
        $sub_product_quantities_array = explode (",", $sub_product_quantities);
        if(empty($sub_product_quantities_array)) $sub_product_quantities_array = $sub_product_quantities;
        
        $current_quantity = Quantity::whereIn('main_product_id', $main_product_ids_array)->where('consultant_id', $user->id)->first();
        if(!empty($current_quantity))
        {
            return response()->json(array('success' => 0, 'message' => 'This quantity is added before.'), 200);
        }
        
        foreach($main_product_ids_array as $single_main_id)
        {
            $quantity = new Quantity;
            $quantity->main_product_id = $single_main_id;
            $quantity->consultant_id   = $user->id;
            $quantity->save();
    
            for($i=0; $i<count($sub_product_ids_array); $i++)
            {
                $quantity_additional = new QuantityAdditional;
                $quantity_additional->quantity_id    = $quantity->id;
                $quantity_additional->sub_product_id = $sub_product_ids_array[$i];
                $quantity_additional->quantity       = $sub_product_quantities_array[$i];
                $quantity_additional->save();
            }
        }
        
        return response()->json(array('success' => 1, 'message' => 'Quantity is added successfully.'), 200);
    }
    
    public function imageDelete(Request $request)
    {
        $image = ProductImage::find($request->image_id);
        $images_count = $image->product->images()->count();
        
        if($images_count > 1 && $image->delete() ) return response()->json(array('result' => $request->image_id), 200);
        return response()->json(array('result' => 0), 200);
    }
    
    public function handleFavorite(Request $request)
    {
        $product_id   = $request->product_id;
        $target_class = $request->target_class;
        
        /* Remove Favorite */
        if($target_class == 'fa fa-heart-o') $favorite = Favorite::where('product_id', $product_id)->where('user_id', Auth::user()->id)->first()->delete();
        /* Add Favorite */
        else
        {
            $favorite = new Favorite;
            $favorite->user_id    = Auth::user()->id;
            $favorite->product_id = $product_id;
            $favorite->save();
        }
        
        return response()->json(array('target_class' => $target_class, 'product_id' => $product_id), 200);
        
    }
}
