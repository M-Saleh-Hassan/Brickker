<?php

namespace App\Http\Controllers\english;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\UserType;
use App\Models\Currency;
use App\User;

use Auth;

class CategoryController extends Controller
{
    public function index()
    {
        return view('tashtebk.english.category.index');
    }

    public function getProducts($title_tag)
    {
        $category = Category::where('title_tag', $title_tag)->first();

        return view('tashtebk.english.category.subcategory')
        ->with('products', $category->products)
        ->with('category', $category);
    }

    public function getAllProducts($title_tag)
    {
        $category = Category::where('title_tag', $title_tag)->first();
        $subcategories = $category->getSubCategories($category->id);
        $products = $category->getParentCategoryProducts();
        $providers = $category->getProviders();
        
        return view('tashtebk.english.category.category_products')
        ->with('products', $products)
        ->with('category', $category)
        ->with('subcategories', $subcategories)
        ->with('providers', $providers);
    }

    public function getAllProductsCategories(Request $request)
    {
        $categories = Category::where('parent_id', NULL)->get();
        $products = Product::all();
        $current_category = $request->category;
        $current_provider = $request->provider;

        return view('tashtebk.english.category.all')
        ->with('products', $products)
        ->with('categories', $categories)
        ->with('current_category', $current_category)
        ->with('current_provider', $current_provider);
    }
    
    public function filterProducts(Request $request)
    {
        $active_currency = Currency::where('active',1)->first();
        $categories_filter_ids = $request->categories_filter;
        $user_types_filter_ids = $request->user_types_filter;
        $low_price             = $request->low_price;
        $high_price            = $request->high_price;
        
        $user_types = new UserType;
        $user_types = (empty($user_types_filter_ids)) ? $user_types->getAvailableTypes() : $user_types->getAvailableFilteredTypes($user_types_filter_ids);
        $content = '';
        if(!empty($categories_filter_ids)):
            
            foreach ($user_types as $user_type):
            if($user_type->hasFilteredProducts($categories_filter_ids, $low_price, $high_price)):
                $content .= '<div class="row">';
                $content .= '    <h3 class="title-related">'.ucfirst($user_type->type).'</h3>';
                $content .= '    <div class="swiper-container swiper-multirows">';
                $content .= '        <div class="swiper-wrapper">';
                                        foreach($user_type->users as $user):
                                            foreach($user->filteredProducts($categories_filter_ids, $low_price, $high_price) as $product):
                $content .= '                  <div class="swiper-slide">';
                $content .= '                   <div class="p-item relate-item">';
                                                    if($product->discount > 0):
                $content .= '                       <div class="product__price-tag">';
                $content .= '                 			<p class="product__price-tag-price">' . $product->current_price . $active_currency->title_en . '</p>';
                $content .= '                     	</div>';
                                                	endif;
                $content .= '                        <div class="img-item">';
                $content .= '                           <a href="' . route('en.product.index', ['title_tag'=>$product->title_tag]) . '"><img src="' . asset('').$product->image. '" alt="" style="height:110px;"></a>';
                $content .= '                        </div>';
                                        
                $content .= '                        <div class="p-info">';
                $content .= '                            <a href="' . route('en.product.index', ['title_tag'=>$product->title_tag]) . '"><h4>'.$product->title.' </h4></a>';
                $content .= '                            <div>';
                                                            if(Auth::check()):
                $content .= '                               <a href="#" class="add-favorite" data-productid="' . $product->id . '"><i class="' . $product->getFavoriteClass(Auth::user()->id) . '"></i></a>';
                                                            else:
                $content .= '                               <a href="#"><i class="fa fa-heart-o"></i></a>';
                                                            endif;
                $content .= '                                <a href="'.route('en.product.index', ['title_tag'=>$product->title_tag]).'"><i class="fa fa-shopping-cart"></i></a>';
                $content .= '                                <span class="price-p';
                                                             if($product->discount > 0) $content .= ' line-through';
                $content .= '                                ">'.$product->price . $active_currency->title_en . '</span>';
                $content .= '                            </div>';
                $content .= '                        </div>';
                $content .= '                    </div>';
                $content .= '                  </div>';
                                            endforeach;
                                        endforeach;
                $content .= '        </div>';
                        
                $content .= '        <div class="swiper-pagination"></div>';
                $content .= '    </div>';
                $content .= '</div>';
            endif;
            endforeach;
            
        else: // Handling when filter has no checked category item
            foreach ($user_types as $user_type):
            if($user_type->hasProducts() && $user_type->hasProductsAtRange($low_price, $high_price)):
                $content .= '<div class="row">';
                $content .= '    <h3 class="title-related">'.ucfirst($user_type->type).'</h3>';
                $content .= '    <div class="swiper-container swiper-multirows">';
                $content .= '        <div class="swiper-wrapper">';
                                        foreach($user_type->users as $user):
                                            foreach($user->filteredProducts(0, $low_price, $high_price) as $product):
                $content .= '                  <div class="swiper-slide">';
                $content .= '                   <div class="p-item relate-item">';
                                                    if($product->discount > 0):
                $content .= '                       <div class="product__price-tag">';
                $content .= '                 			<p class="product__price-tag-price">' . $product->current_price . $active_currency->title_en . '</p>';
                $content .= '                     	</div>';
                                                	endif;
                $content .= '                        <div class="img-item">';
                $content .= '                            <a href="' . route('en.product.index', ['title_tag'=>$product->title_tag]) . '"><img src="' . asset('').$product->image. '" alt="" style="height:110px;"></a>';
                $content .= '                        </div>';
                                        
                $content .= '                        <div class="p-info">';
                $content .= '                            <a href="' . route('en.product.index', ['title_tag'=>$product->title_tag]) . '"><h4>'.$product->title.' </h4></a>';
                $content .= '                            <div>';
                                                            if(Auth::check()):
                $content .= '                               <a href="#" class="add-favorite" data-productid="' . $product->id . '"><i class="' . $product->getFavoriteClass(Auth::user()->id) . '"></i></a>';
                                                            else:
                $content .= '                               <a href="#"><i class="fa fa-heart-o"></i></a>';
                                                            endif;
                $content .= '                                <a href="'.route('en.product.index', ['title_tag'=>$product->title_tag]).'"><i class="fa fa-shopping-cart"></i></a>';
                $content .= '                                <span class="price-p';
                                                             if($product->discount > 0) $content .= ' line-through';
                $content .= '                                 ">'.$product->price. $active_currency->title_en .'</span>';
                $content .= '                            </div>';
                $content .= '                        </div>';
                $content .= '                    </div>';
                $content .= '                  </div>';
                                            endforeach;
                                        endforeach;
                $content .= '        </div>';
                        
                $content .= '        <div class="swiper-pagination"></div>';
                $content .= '    </div>';
                $content .= '</div>';
            endif;
            endforeach;            
        endif;
        
        return response()->json(array('result' => $content), 200);
    }
    
}
