<?php

namespace App\Http\Controllers\english;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\About;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        
        return view('tashtebk.english.about.index')
        ->with('about', $about);
    }
}
