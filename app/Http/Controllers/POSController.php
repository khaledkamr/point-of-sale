<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class POSController extends Controller
{
    public function index() {
        $categories = Category::all();
        $products = Product::with('category')->get();

        return view('pages.pos.index', compact('categories', 'products'));
    }
}
