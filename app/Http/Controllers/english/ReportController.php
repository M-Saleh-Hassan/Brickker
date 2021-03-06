<?php

namespace App\Http\Controllers\english;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Report;
use Auth;

class ReportController extends Controller
{
    public function send(Request $request)
    {
        $report = new Report;
        $report->user_id = Auth::User()->id;
        $report->product_id = $request->product;
        $report->message = $request->message;
        $report->save();
        
        return redirect()->back()->with('success','Your Message Sent Successfully.');
    }
    
    public function index()
    {
    	return view('tashtebk.english.howtowork.index');
    }
    
    
}
