<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();

        return view('products.index', compact('categories', 'products'));
    }

    public function show($id)
    {
        $categories = Category::all();
        $currentCategory = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->get();

        return view('products.index', compact('categories', 'products', 'currentCategory'));
    }
}
