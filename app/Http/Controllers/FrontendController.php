<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function welcome()
    {
        $categories = Category::with('products')->get();
        return view('welcome', compact('categories'));
    }

    public function categoryWiseProducts($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products()->paginate(12);
        
        return view('specific', compact('category', 'products'));
    }

    public function productDetails($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('product_details', compact('product'));
    }
}
