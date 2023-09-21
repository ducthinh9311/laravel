<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $product = Product::orderBy('created_at', 'desc')->limit(8)->get();
        return view('client.pages.home',['products' => $product]);
    }
}