<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    function home(){
        $list_product = Product::where('censorship_id', 1)->get();
        
        return view('guest.home', compact('list_product'));
    }
}
