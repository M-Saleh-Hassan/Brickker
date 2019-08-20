<?php

namespace App\Http\Controllers\arabic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;

use App\User;
use App\Models\Notification;
use App\Models\Currency;
use App\Models\Scale;
use App\Models\ScaleStep;
use App\Models\Subscription;
use App\Models\Category;
use App\Models\Product;
use App\Models\Offer;

class ScaleController extends Controller
{
    public function index()
    {
        $scales = Scale::orderBy('order','ASC')->get();
        
        return view('tashtebk.arabic.scale.index')
        ->with('scales', $scales);
    }
    
    public function steps($username_tag, $scale_title, $identifier)
    {
        $scale = Scale::where('title', $scale_title)->first();
        if(empty($scale)) return redirect()->route('ar.home.index');
        $subscription = Subscription::where('identifier', $identifier)->first();
        $categories = Category::where('parent_id', NULL)->get();
        
        return view('tashtebk.arabic.scale.steps')
        ->with('scale', $scale)
        ->with('subscription', $subscription)
        ->with('categories', $categories);
    }

    public function getSteps(Request $request, $username_tag)
    {
        $user = User::where('username_tag', $username_tag)->first();
        $scale = Scale::find($request->scale_id);
        $identifier = uniqid();
        
        $subscription = new Subscription;
        $subscription->scale_id   = $request->scale_id;
        $subscription->user_id    = $user->id;
        $subscription->identifier = $identifier;
        $subscription->save();
        
        $project_modal = view('tashtebk.arabic.scale.project_modal')
                        ->with('redirect',  route('en.scale.steps', [$username_tag, $scale->title, $identifier]))
                        ->with('subscription',  $subscription)
                        ->with('projects', Auth::user()->projects)
                        ->render();
        return response()->json(array('redirect' => route('en.scale.steps', [$username_tag, $scale->title, $identifier]), 'project_modal'=> $project_modal), 200);

    }
    
    public function getStepProducts(Request $request)
    {
        $active_currency = Currency::where('active',1)->first();
        
        $user_id = $request->user_id;
        $user = User::find($user_id);
        
        $step_id = $request->step_id;
        $step = ScaleStep::find($step_id);
        
        $categories_id = [];
        foreach($step->categories as $category)$categories_id[] = $category->id;

        $products = $user->products()->whereIn('category_id', $categories_id)->get();
        
        $content = '';
        foreach ($products as $product):
            $content .= '<div class="col-md-2">';
            $content .=     '<div class="p-item relate-item">';
            // if(strpos($additional_products_current_value, $product->title_tag) !== false)$content .= '<div class="check"><i class="fa fa-check"></i></div>';
            $content .=         '<div class="overlay-product">';
            $content .=             '<div class="elements">';
            $content .=                 '<a class="primary add-step-product"  title="Add" data-content="'.$product->id.'" data-step="'.$step_id.'" ><i class="fa fa-plus"></i></a>';
            $content .=                 '<a href="' . route('en.product.index', ['title_tag'=>$product->title_tag]) . '" class="success" title="view" target="_blank"><i class="fa fa-eye"></i></a>';
            // $content .=                 '<a class="danger delete-additional-product" title="Delete" data-content="'.$product->title_tag.'"><i class="fa fa-close"></i></a>';
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
            $content .=                 '<span class="price-p">' . $product->current_price . $active_currency->title_ar . '</span>';
            $content .=             '</div>';
            $content .=         '</div>';
            
            $content .=     '</div>';
            $content .= '</div>';                                                                   
        endforeach;
        return response()->json(array('result' => $content, 'step_id' => $step_id), 200);
    }
    
    public function getOfferModal(Request $request)
    {
        $product_id  = $request->product_id;
        $product     = Product::find($product_id);
        
        $step_id     = $request->step_id;
        $step        = ScaleStep::find($step_id);
        
        $provider_id = $request->provider_id;
        $provider    = User::find($provider_id);
        
        $identifier = $request->subscription_identifier;
        $subscription = Subscription::where('identifier', $identifier)->first();
        
        $modal = view('tashtebk.arabic.scale.offer_modal')
        ->with('product', $product)
        ->with('provider', $provider)
        ->with('step', $step)
        ->with('subscription', $subscription)
        ->render();
        
        return response()->json(array('step_id' => $step_id, 'modal' => $modal), 200);
    }
    
    public function makeOffer(Request $request)
    {
        $step_provider = $request->step_provider;
        $provider = User::where('username', $step_provider)->first();
        
        $step_product  = $request->step_product ;
        $product = Product::where('title', $step_product)->first();
        
        $identifier = $request->subscription_identifier;
        $subscription = Subscription::where('identifier', $identifier)->first();
        
        $step_quantity = $request->step_quantity;
        $step_message  = $request->step_message;
        $step_id       = $request->step_id;
        $step_from_user= $request->user_id;
        
        $offer = new Offer;
        $offer->subscription_id = $subscription->id;
        $offer->step_id         = $step_id;
        $offer->product_id      = $product->id;
        $offer->from_user       = $step_from_user;
        $offer->to_user         = $provider->id;
        $offer->floor_id        = $request->floor_id;
        $offer->flat_id         = $request->flat_id;
        $offer->room_id         = $request->room_id;
        $offer->projection_id   = $request->projection_id;
        $offer->quantity        = $step_quantity;
        $offer->message         = $step_message;
        $offer->save();

        // Send Notification
        if(Auth::user()->getUserType() == 'customer')
        {
            $notification             = new Notification;
            $notification->type_id    = 1; //offer
            $notification->from_user  = Auth::user()->id;
            $notification->to_user    = $product->user_id;
            $notification->product_id = $product->id;
            $notification->offer_id   = $offer->id;
            $notification->save();
        }
        
        $offer_row = view('tashtebk.arabic.scale.offer_data_row')
        ->with('offer', $offer)
        ->render();
        
        $boq_updated_modal = view('tashtebk.arabic.scale.boq_modal_details')
        ->with('subscription',$subscription)
        ->render();

        
        return response()->json(array('step_id' => $step_id, 'message' => 'Offer is sent successfully.', 'offer_new_row' => $offer_row, 'boq_updated_modal' => $boq_updated_modal), 200);
    }
    
    public function deleteOffer(Request $request)
    {
        $offer_id = $request->offer_id;
        $offer = Offer::find($offer_id);
        $step_id = $offer->step_id;
        $subscription = $offer->subscription;
        
        if(empty($offer))return response()->json(array('result' => 0), 200);
        
        $offer->delete();

        // Delete corresponding Notification
        $notification = Notification::where('type_id', 1)->where('offer_id',$offer_id)->first();
        if(!empty($notification))$notification->delete();
        
        $boq_updated_modal = view('tashtebk.arabic.scale.boq_modal_details')
        ->with('subscription',$subscription)
        ->render();

        return response()->json(array('result' => $offer_id, 'step_id' => $step_id, 'boq_updated_modal' => $boq_updated_modal), 200);
    }
}
