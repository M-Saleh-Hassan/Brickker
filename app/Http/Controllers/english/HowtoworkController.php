<?php

namespace App\Http\Controllers\english;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Howtowork;

class HowtoworkController extends Controller
{
    public function index()
    {
        $items = Howtowork::orderBy('order', 'ASC')->get();

        return view('tashtebk.english.howtowork.index')
        ->with('items', $items);
    }
}
