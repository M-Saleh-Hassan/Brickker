<?php

namespace App\Http\Controllers\arabic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Setting;
use Mail;

class ContactController extends Controller
{
    public function index()
    {
    	$contact = Setting::first();
        return view('tashtebk.arabic.contact.index')
        ->with('contact', $contact);
    }

    public function send(Request $request)
    {
        $contact = Contact::create($request->all());

        $data=array('contact'=>$contact);
        Mail::send('tashtebk.english.emails.contactus.email',['data' => $data, 'contact' => $contact],function($message) use ($data,$contact){
            $message->to('contactus@brickker.com','Brickker Team')
                    ->subject('Success Contact Us');
            $message->from('contactus@brickker.com','Brickker Team');
        });


        return redirect()->back()->with('success', 'تم إرسال  رسالتك بنجاح');
    }

}
