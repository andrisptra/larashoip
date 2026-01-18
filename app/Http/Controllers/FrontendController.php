<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('welcome', compact('products'));
    }
}
