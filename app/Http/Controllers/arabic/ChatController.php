<?php

namespace App\Http\Controllers\arabic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Auth;

class ChatController extends Controller
{
    public function index()
    {
        return view('tashtebk.arabic.chat.index');
    }
    
    public function send(Request $request)
    {
        $message = new Message;
        $message->from_user = Auth::User()->id;
        $message->to_user = $request->user;
        $message->message = $request->message;
        $message->save();
        
        return redirect()->back();
    }

}
