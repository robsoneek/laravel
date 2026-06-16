<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('name')->get();
        return view('admin.index', compact('products'));
    }

    public function decrease($id)
    {
        $product = Product::findOrFail($id);
        if ($product->quantity > 0) {
            $product->decrement('quantity');
        }
        return back();
    }

    public function destroyProduct($id)
    {
        Product::findOrFail($id)->delete();
        return back();
    }
}
