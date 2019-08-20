<?php

namespace App\Http\Controllers\arabic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Models\Product;
use App\Models\Review;
use App\Models\ReviewHelpful;

class ReviewController extends Controller
{
    public function openReviewModal(Request $request, $product_title_tag)
    {
        $product = Product::where('title_tag', $product_title_tag)->first();
        $rate = $request->rate;
        $review_modal = view('tashtebk.arabic.product.review_modal')
        ->with('rate', $rate)
        ->with('product', $product)
        ->render();
        
        return response()->json(array('review_modal' => $review_modal, 'rate' => $rate), 200);
    }
    
    public function save(Request $request, $product_title_tag)
    {
        $product = Product::where('title_tag', $product_title_tag)->first();
        $rate = $request->rate;
        $good = $request->good;
        $bad  = $request->bad;
        $recommend  = $request->recommend;
        $review_text  = $request->review;
        
        $review = Review::where('product_id', $product->id)->where('user_id', Auth::user()->id)->first();
        if(!empty($review)) return response()->json(array('success' => '0', 'message' => 'Review is added before'), 200);
        
        $review = new Review;
        $review->product_id = $product->id;
        $review->user_id    = Auth::user()->id;
        $review->rate       = $rate;
        $review->good       = $good;
        $review->bad        = $bad;
        $review->recommend  = $recommend;
        $review->review  = $review_text;
        $review->save();
        
        return response()->json(array('success' => '1', 'message' => 'Review is added successfully', 'rate' => $rate), 200);
    }
    
    public function helpful(Request $request, $product_title_tag)
    {
        $product = Product::where('title_tag', $product_title_tag)->first();
        $review_id = $request->review_id;
        
        $helpful = ReviewHelpful::where('review_id', $review_id)->where('user_id', Auth::user()->id)->first();
        if(!empty($helpful)) return response()->json(array('success' => '0', 'message' => 'Review Helpful is added before', 'review_id' => $review_id), 200);
        
        $helpful = new ReviewHelpful;
        $helpful->review_id = $review_id;
        $helpful->user_id   = Auth::user()->id;
        $helpful->helpful   = 1;
        $helpful->save();
        
        return response()->json(array('success' => '1', 'message' => 'Review Helpful is added successfully', 'review_id' => $review_id), 200);
    }
    
    public function nothelpful(Request $request, $product_title_tag)
    {
        $product = Product::where('title_tag', $product_title_tag)->first();
        $review_id = $request->review_id;
        
        $helpful = ReviewHelpful::where('review_id', $review_id)->where('user_id', Auth::user()->id)->first();
        if(!empty($helpful)) return response()->json(array('success' => '0', 'message' => 'Review Helpful is added before', 'review_id' => $review_id), 200);
        
        $helpful = new ReviewHelpful;
        $helpful->review_id = $review_id;
        $helpful->user_id   = Auth::user()->id;
        $helpful->helpful   = 0;
        $helpful->save();
        
        return response()->json(array('success' => '1', 'message' => 'Review Helpful is added successfully', 'review_id' => $review_id), 200);
    }
}
