<?php

namespace App\Http\Controllers\english;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Setting;
use Mail;

class ContactController extends Controller
{
    public function index(Request $request)
    {
    	$contact = Setting::first();
        return view('tashtebk.english.contact.index')
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

        return redirect()->back()->with('success', 'Message Sent Successfully.');
    }

}
