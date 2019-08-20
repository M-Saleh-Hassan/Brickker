<?php

namespace App\Http\Controllers\english;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Term;

class TermController extends Controller
{
    public function index()
    {
        $term = Term::first();

        return view('tashtebk.english.termsofservice.index')
        ->with('term', $term);
    }
}
