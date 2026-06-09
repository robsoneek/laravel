<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        $categories = $this->buildTree();
        return view('products.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $categories = $this->buildTree();
        return view('products.show', compact('product', 'categories'));
    }

    private function buildTree()
    {
        $all = Category::all();
        $indexed = $all->keyBy('id');
        $tree = collect();

        foreach ($indexed as $cat) {
            if (is_null($cat->parent_id)) {
                $tree->push($cat);
            } else {
                $indexed[$cat->parent_id]->children_loaded[] = $cat;
            }
        }

        return $tree;
    }
}
