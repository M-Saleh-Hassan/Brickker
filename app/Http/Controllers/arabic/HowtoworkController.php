<?php

namespace App\Http\Controllers\arabic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Howtowork;

class HowtoworkController extends Controller
{
    public function index()
    {
        $items = Howtowork::orderBy('order', 'ASC')->get();

        return view('tashtebk.arabic.howtowork.index')
        ->with('items', $items);
    }
}
