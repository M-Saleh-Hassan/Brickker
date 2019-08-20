<?php

namespace App\Http\Controllers\arabic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Subscription;
use App\Models\Notification;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        return view('tashtebk.arabic.checkout.index');
    }

    public function delete(Request $request)
    {
        $subscription_id = $request->subscription_id;
        $subscription = Subscription::find($subscription_id);
        
        if(empty($subscription))return response()->json(array('result' => 0), 200);
        
        $subscription->delete();
        return response()->json(array('result' => $subscription_id), 200);
    }
    
    public function addToCart(Request $request, $product_id, $username_tag)
    {
        $new_count   = $request->new_count;
        $quantity    = $request->quantity;
        $product     = Product::find($product_id);
        $user        = User::where('username_tag', $username_tag)->first();
        $total_price = $product->current_price * $quantity;
        
        $order             = new Order;
        $order->user_id    = $user->id;
        $order->product_id = $product->id;
        $order->quantity   = $quantity;
        $order->save();

        // Send Notification
        if($user->getUserType() == 'customer')
        {
            $notification             = new Notification;
            $notification->type_id    = 2; //order
            $notification->from_user  = $user->id;
            $notification->to_user    = $product->user_id;
            $notification->product_id = $product_id;
            $notification->offer_id   = $order->id;
            $notification->save();
        }
        
        $new_row = view('tashtebk.arabic.checkout.checkout_row')
        ->with('order', $order)
        ->render();
        
        return response()->json(array('new_count' => $new_count, 'new_row' => $new_row), 200);
    }
    
    public function deleteOrder(Request $request)
    {
        $order_id = $request->order_id;
        $order = Order::find($order_id);
        
        if(empty($order))return response()->json(array('result' => 0), 200);
        
        $order->delete();
        
        // Delete corresponding Notification
        $notification = Notification::where('type_id', 2)->where('offer_id',$order_id)->first();
        if(!empty($notification))$notification->delete();

        return response()->json(array('result' => $order_id), 200);
        
    }
}
