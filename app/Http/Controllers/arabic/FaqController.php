<?php

namespace App\Http\Controllers\arabic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::OrderBy('order', 'Asc')->get();
        
        return view('tashtebk.arabic.faq.index')
        ->with('faqs', $faqs);
    }
}
