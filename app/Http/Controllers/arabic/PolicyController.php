<?php

namespace App\Http\Controllers\arabic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Policy;

class PolicyController extends Controller
{
    public function index()
    {
        $policy = Policy::find(1);
        
        return view('tashtebk.arabic.policy.index')
        ->with('policy', $policy);
    }
}
