<?php

namespace App\Http\Controllers\english;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::OrderBy('order', 'Asc')->get();

        return view('tashtebk.english.faq.index')
        ->with('faqs', $faqs);
    }
}
