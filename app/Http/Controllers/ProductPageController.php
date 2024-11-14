<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductPageController extends Controller
{
    //
    public function index()
    {
        $products = Product::all();
        return view('pages.home', compact('products'));
    }
    public function detail($id){
        $product=Product::findOrFail($id);
        return view('pages.detail', compact('product'));
    }
}
