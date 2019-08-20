<?php

namespace App\Http\Controllers\english;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Mail;
use Auth;

use App\User;
use App\Models\Category;
use App\Models\Media;
use App\Models\Slider;
use App\Models\Setting;
use App\Models\UserType;

use App\Models\Product;
use App\Models\Project;
use App\Models\Order;
use App\Models\Favorite;
use App\Models\Scale;
use App\Models\Offer;
use App\Models\ScaleStep;
use App\Models\Subscription;
use App\Events\ProductCreation;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where([
            ['parent_id', NULL],
            ['home', 1],
            ['show', 1]
        ])->get();
        $slides  = Slider::orderBy('slide_order', 'asc')->get();
        $setting = Setting::first();
        $user_types = new UserType;
        $user_types = $user_types->getAvailableTypes();
        $featured_products = Product::where('featured', 1)->get();
        
        return view('tashtebk.english.home.index')
        ->with('categories', $categories)
        ->with('slides', $slides)
        ->with('user_types', $user_types)
        ->with('setting', $setting)
        ->with('featured_products', $featured_products);
    }

    public function search(Request $request)
    {
        $search_value = $request->search_value;
        $products = Product::where('title', 'LIKE', '%'.$search_value.'%')->get();
        
        $result = view('tashtebk.english.home.search-div')
        ->with('products', $products)
        ->render();
        
        return response()->json(array('result' => $result), 200);

    }
    
    public function test()
    {
        return User::find(3);
        // $product = Product::find(6);
        // event(new ProductCreation($product));
        
        $project = Project::find(4);
        // $step = ScaleStep::find(2);
        return json_encode($project->floors);
        $categories_id = [];
        foreach($step->categories as $category)$categories_id[] = $category->id;
        
        $products = $user->products()->whereIn('category_id', $categories_id)->get();
        return json_encode($products);
        // $test = UserType::find(2);
        // return json_encode($test->getAvailableFilteredTypes([2]));
        // return json_encode(Auth::user()->filteredProducts([17,18,19,20,23], 30, 100));
        $data=array('name'=>'mohamed','email'=>'mmmmmm@gmail.com');
        Mail::send('tashtebk.emails.testmail',$data,function($message){
            $message->to('mohammedd.salehh@gmail.com','saleh')
                    ->subject('testmail');
            $message->from('tashtebk@gmail.com','tashtebkteam') ;       
        });
        echo "check your mail";
    }
}
