<?php

namespace App\Http\Controllers\arabic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\About;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        
        return view('tashtebk.arabic.about.index')
        ->with('about', $about);
    }
}
