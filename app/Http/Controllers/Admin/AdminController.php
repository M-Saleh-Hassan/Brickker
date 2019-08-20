<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Product;

class AdminController extends Controller
{
    public function index()
    {
        $users_count = User::get()->count() - 1;
        $products_count = Product::get()->count();

        return view('admin.home.index')
        ->with('users_count', $users_count)
        ->with('products_count', $products_count);
    }
}
