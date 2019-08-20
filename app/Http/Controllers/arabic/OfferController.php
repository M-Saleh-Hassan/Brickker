<?php

namespace App\Http\Controllers\arabic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Offer;
use App\Models\Notification;
use App\User;

class OfferController extends Controller
{
    public function index($username_tag)
    {
        return view('tashtebk.arabic.offer.index');
    }
    
    public function accept(Request $request)
    {
        $offer_id = $request->offer_id;
        $offer = Offer::find($offer_id); 
        $offer->status = 1;
        $offer->save();
        
        $new_row = view('tashtebk.arabic.offer.accepted_row')
        ->with('offer', $offer)
        ->render();

        // Send Notification
        $notification             = new Notification;
        $notification->type_id    = 1; //offer
        $notification->from_user  = $offer->to_user;
        $notification->to_user    = $offer->from_user;
        $notification->product_id = $offer->product_id;
        $notification->offer_id   = $offer_id;
        $notification->save();
        
        return response()->json(array('result' => $offer_id, 'row' => $new_row), 200);
    }
    
    public function reject(Request $request)
    {
        $offer_id = $request->offer_id;
        $offer = Offer::find($offer_id); 
        $offer->status = -1;
        $offer->save();
        
        $new_row = view('tashtebk.arabic.offer.rejected_row')
        ->with('offer', $offer)
        ->render();

        // Send Notification
        $notification             = new Notification;
        $notification->type_id    = 1; //offer
        $notification->from_user  = $offer->to_user;
        $notification->to_user    = $offer->from_user;
        $notification->product_id = $offer->product_id;
        $notification->offer_id   = $offer_id;
        $notification->status     = 0;
        $notification->save();

        return response()->json(array('result' => $offer_id, 'row' => $new_row), 200);
    }
    
    public function providerDeliveryStatus(Request $request)
    {
        $offer_id = $request->offer_id;
        $status   = $request->status;
        $offer = Offer::find($offer_id); 
        $new_icon = "";
        if($status == '0')
        {
            $offer->provider_delivered = 1;
            $new_icon = '<a href="#" class="fa fa-check deliver-offer" data-offerid="' . $offer_id . '" data-status="1" title="Delivered"></a>';
        }
        elseif($status == '1')
        {
            $offer->provider_delivered = 0;
            $new_icon = '<a href="#" class="fa fa-close deliver-offer" data-offerid="' . $offer_id . '" data-status="0" title="Not Delivered"></a>';
        }
        $offer->save();
        
        
        return response()->json(array('result' => $offer_id, 'icon' => $new_icon), 200);
    }
}
