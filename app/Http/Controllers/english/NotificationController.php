<?php

namespace App\Http\Controllers\english;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Auth;

class NotificationController extends Controller
{
    public function clear()
    {
        $notifications = Notification::where('to_user', Auth::user()->id)->where('seen', 0)->update(['seen' => 1]);
        
        return response()->json(['result'=> 'success'], 200);
    }
}
