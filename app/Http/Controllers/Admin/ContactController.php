<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Contact;
use App\Models\Setting;


use Validator;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        $contact = Setting::first();
	
        return view('admin.contacts.index')
        ->with('contacts', $contacts)
        ->with('contact', $contact);
    }

    public function delete(Request $request)
    {
        $contact = Contact::find($request->id);
        $contact->delete();
        return response()->json(array('id' => $request->id), 200);
    }

    public function text(Request $request)
    {

	    $contact_text = $request->contact_text ;
	    $contact_text_ar = $request->contact_text_ar ;
	    
	    $contact = Setting::first();
	    $contact->contact_text= $contact_text ;
	    $contact->contact_text_ar= $contact_text_ar ;
	    $contact->save();
	
	
	    return response()->json([
	        'message'        => 'Contact Text saved Successfully',
	        'errors'         => '',
	
	    ]);
    }
}
